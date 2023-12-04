<?php

namespace App\MyMethod;

use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DistrictMethod
{
    public static function getCountPendingForm($table, $sub_table)
    {
        $count = DB::table($table . ' as main_table')
            ->select(
                'main_table.*',
                'sub_table.*'
            )
            ->where('main_table.district_id', Auth::user()->district)
            ->where('sub_table.district_approval', '1')
            ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
            ->count();
        return $count;
    }
    public static function GetFormList($table, $sub_table, $columns)
    {
        $district_code = Auth::user()->district;
        $lists = DB::table($table . ' as main_table')
            ->where('main_table.district_id', $district_code)
            ->where('sub_table.district_approval', '1')
            ->select(
                'main_table.' . $columns[0],
                'main_table.' . $columns[1],
                'main_table.' . $columns[2],
                'main_table.request_id',
                'main_table.date_of_submit',
                'main_table.approval_status',
                'sub_table.*',
                'main_table.id as main_id'
            )
            ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
            ->get();
        return $lists;
    }
    public static function checkIsDateValid($date, $table)
    {
        $check_date = DB::table($table)->where('district_id', Auth::user()->district)->where('date_of_submit', $date)->get();
        if (count($check_date) == 0) {
            return false;
        } else {
            return true;
        }
    }
    public static function getFromdata($date, $table)
    {
        $form_data = DB::table($table)->where('district_id', Auth::user()->district)->where('date_of_submit', $date)->get();
        return $form_data;
    }
    public static function searchByDate($table, $form_date, $to_date)
    {
        $message = null;
        $status = null;
        if ($form_date == null || $to_date == "") {
            $status = 400;
            $message = "Please Select Form Submission dates ";
        } else {
            if ($form_date <= $to_date) {
                $period = new DatePeriod(
                    new DateTime($form_date),
                    new DateInterval('P1D'),
                    new DateTime($to_date)
                );
                $form_to_date = array();
                foreach ($period as $key => $value) {
                    array_push($form_to_date, $value->format('Y-m-d'));
                }
                $date_one = date($to_date, strtotime('+1 day'));
                array_push($form_to_date, $date_one);
                $form_date_his = array();
                foreach ($form_to_date as $dates) {
                    if (DistrictMethod::checkIsDateValid($dates, $table)) {
                        $form_data = DistrictMethod::getFromdata($dates, $table);
                        array_push($form_date_his, $form_data);
                    }
                }
                $message = $form_date_his;
                $status = 200;
            } else {
                $message = "Select Valid Dates ";
                $status = 400;
            }
        }
        return [$status, $message];
    }
    // Get District Name
    public static function getDistrictName()
    {
        $district_name = DB::table('districts')
            ->where('district_code', Auth::user()->district)
            ->select('district_name')
            ->get();
        return $district_name[0]->district_name;
    }
    // Get All Block Names 
    public static function getBlocksName()
    {
        $block_names = DB::table('blocks')
            ->where('district_id', Auth::user()->district)
            ->orderBy('block_name', 'asc')
            ->get();
        return $block_names;
    }
    // Get Gp Name By Block
    public static function getGpByBlock($block_id)
    {
        $gp_names = DB::table('gram_panchyats')
            ->where('block_id', $block_id)
            ->select('gram_panchyat_id', 'gram_panchyat_name')
            ->orderBy('gram_panchyat_name', 'asc')
            ->get();
        return $gp_names;
    }
    // Serach By Block,Gp And dates 
    public static function searchByBlockGpDates($form_date, $to_date, $block_name, $gp_name, $table, $sub_table, $status_key)
    {
        $status = null;
        $message = null;
        if ($form_date === null && $to_date === null && $block_name === null && $gp_name === null) {
            $status = 200;
            $result = DB::table($table . ' as main_table')
                ->select(
                    'main_table.*',
                    'sub_table.*',
                    'main_table.id as main_id'
                )
                ->where('main_table.district_id', Auth::user()->district)
                ->where('sub_table.district_approval', $status_key)
                ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
                ->get();
            $message = array($result);
        } else {
            if (($form_date === null && $to_date !== null) || ($form_date !== null && $to_date === null)) {
                $status = 400;
                $message = "Select Both Dates";
            } else {
                if ($form_date !== null && $block_name !== null && $gp_name !== null) {
                    if ($form_date <= $to_date) {
                        $form_to_date = DistrictMethod::getPeriodDates($form_date, $to_date);
                        $form_date_his = array();
                        foreach ($form_to_date as $dates) {
                            if (DistrictMethod::checkIsDateAvai($table, $dates)) {
                                $form_data = DB::table($table . ' as main_table')
                                    ->select(
                                        'main_table.*',
                                        'sub_table.*',
                                        'main_table.id as main_id'
                                    )
                                    ->where('main_table.district_id', Auth::user()->district)
                                    ->where('sub_table.district_approval', $status_key)
                                    ->where('main_table.date_of_submit', $dates)
                                    ->where('main_table.gp_id', $gp_name)
                                    ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
                                    ->get();
                                array_push($form_date_his, $form_data);
                            }
                        }
                        // $message = "All Filter data";
                        $status = 200;
                        $message = $form_date_his;
                    } else {
                        $status = 400;
                        $message = "Select A Valid Dates";
                    }
                } else {
                    if ($form_date !== null && $block_name !== null) {
                        if ($form_date <= $to_date) {
                            $form_to_date = DistrictMethod::getPeriodDates($form_date, $to_date);
                            $form_date_his = array();
                            foreach ($form_to_date as $dates) {
                                if (DistrictMethod::checkIsDateAvai($table, $dates)) {
                                    $form_data = DB::table($table . ' as main_table')
                                        ->select(
                                            'main_table.*',
                                            'sub_table.*',
                                            'main_table.id as main_id'
                                        )
                                        ->where('main_table.district_id', Auth::user()->district)
                                        ->where('sub_table.district_approval', $status_key)
                                        ->where('main_table.block_id', $block_name)
                                        ->where('main_table.date_of_submit', $dates)
                                        ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
                                        ->get();
                                    array_push($form_date_his, $form_data);
                                }
                            }
                            $status = 200;
                            $message = $form_date_his;
                        } else {
                            $status = 400;
                            $message = "Select A Valid Dates";
                        }
                    } else {
                        if ($block_name !== null) {
                            if ($gp_name !== null) {
                                $result = DB::table($table . ' as main_table')
                                    ->select(
                                        'main_table.*',
                                        'sub_table.*',
                                        'main_table.id as main_id'
                                    )
                                    ->where('main_table.district_id', Auth::user()->district)
                                    ->where('sub_table.district_approval', $status_key)
                                    ->where('main_table.block_id', $block_name)
                                    ->where('main_table.gp_id', $gp_name)
                                    ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
                                    ->get();
                                $message = array($result);
                            } else {
                                $result = DB::table($table . ' as main_table')
                                    ->select(
                                        'main_table.*',
                                        'sub_table.*',
                                        'main_table.id as main_id'
                                    )
                                    ->where('main_table.district_id', Auth::user()->district)
                                    ->where('sub_table.district_approval', $status_key)
                                    ->where('main_table.block_id', $block_name)
                                    ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
                                    ->get();
                                $message = array($result);
                            }
                            $status = 200;
                        } else {
                            if ($form_date !== null) {
                                if ($form_date <= $to_date) {
                                    $status = 200;
                                    $form_to_date = DistrictMethod::getPeriodDates($form_date, $to_date);
                                    $form_date_his = array();
                                    foreach ($form_to_date as $dates) {
                                        if (DistrictMethod::checkIsDateAvai($table, $dates)) {
                                            $form_data = DB::table($table . ' as main_table')
                                                ->select(
                                                    'main_table.*',
                                                    'sub_table.*',
                                                    'main_table.id as main_id'
                                                )
                                                ->where('main_table.district_id', Auth::user()->district)
                                                ->where('sub_table.district_approval', $status_key)
                                                ->where('main_table.date_of_submit', $dates)
                                                ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
                                                ->get();
                                            array_push($form_date_his, $form_data);
                                        }
                                    }
                                    $message = $form_date_his;
                                } else {
                                    $status = 400;
                                    $message = "Select A Valid Dates";
                                }
                            }
                        }
                    }
                }
            }
        }
        return [$status, $message];
    }
    // get Period Dates 
    public static function getPeriodDates($form_date, $to_date)
    {
        $period = new DatePeriod(
            new DateTime($form_date),
            new DateInterval('P1D'),
            new DateTime($to_date)
        );
        $form_to_date = array();
        foreach ($period as $key => $value) {
            array_push($form_to_date, $value->format('Y-m-d'));
        }
        $date_one = date($to_date, strtotime('+1 day'));
        array_push($form_to_date, $date_one);
        return $form_to_date;
    }
    public static function checkIsDateAvai($table, $date)
    {
        $check = DB::table($table)
            ->where('district_id', Auth::user()->district)
            ->where('date_of_submit', $date)
            ->get();
        if (count($check) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // Get Approval Form List Data
    public static function loadApprovalData($table, $sub_table)
    {
        $data = DB::table($table . ' as main_table')
            ->select(
                'main_table.*',
                'sub_table.*',
                'main_table.id as main_id'
            )
            ->where('main_table.district_id', Auth::user()->district)
            ->where('sub_table.district_approval', '3')
            ->join($sub_table . ' as sub_table', 'sub_table.form_request_id', '=', 'main_table.request_id')
            ->get();
        return $data;
    }
    // For Delay Form
    public static function viewFormData($table, $delay_form_id)
    {
        $district_code = Auth::user()->district;
        $delay_form_data = DB::table($table)->where('district_id', $district_code)->where('id', $delay_form_id)->get();
        if (count($delay_form_data) == 0) {
            $content = "<p>No data Found</p>";
        } else {
            $img_url = Storage::url($delay_form_data[0]->bank_statement_url);
            $content = '<p class="delay_para_head para_head">Work Code Number</p>
    <p class="delay_para para_1">' . $delay_form_data[0]->code_number . '</p>
    <p class="delay_para_head para_head">MR Number</p>
    <p class="delay_para para_1">' . $delay_form_data[0]->mr_number . '</p>
    <p class="delay_para_head para_head">Person Responsible For Delay</p>
    <p class="delay_para para_1">' . $delay_form_data[0]->person_delay . '</p>
    <p class="delay_para_head para_head">Designation Responsible For Delay</p>
    <p class="delay_para para_1">' . $delay_form_data[0]->designation_delay . '</p>
    <p class="delay_para_head para_head">Recovered Amount</p>
    <p class="delay_para para_1">' . $delay_form_data[0]->recover_amount . '</p>
    <p class="delay_para_head para_head">Date Amount Recovered</p>
    <p class="delay_para para_1">' . $delay_form_data[0]->date_recover_amount . '</p>
    <p class="delay_para_head para_head">Date Deposited To Bank</p>
    <p class="delay_para para_1">' . $delay_form_data[0]->date_deposite_bank . '</p>
    <p class="delay_para_head para_head">Date of Submited </p>
    <p class="delay_para para_1">' . $delay_form_data[0]->date_of_submit . '</p>
    <button id="show_form_document" class="btn btn-primary" value="' . $img_url . '">View Upload Document</button>';
        }
        return $content;
    }
    // For Unemp Allow
    public static function unempViewFormData($table, $delay_form_id)
    {
        $district_code = Auth::user()->district;
        $delay_form_data = DB::table('add_unemp_allowance')->where('district_id', $district_code)->where('id', $delay_form_id)->get();
        if (count($delay_form_data) == 0) {
            $content = "<p>No data Found</p>";
        } else {
            $img_url = Storage::url($delay_form_data[0]->bank_statement_url);
            $content = '<p class="delay_para_head para_head">Work Code Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->card_number . '</p>
            <p class="delay_para_head para_head">MR Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->work_demand . '</p>
            <p class="delay_para_head para_head">Total Day of Unemployement</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->total_day_unemple . '</p>
            <p class="delay_para_head para_head">Person Responsible For Delay</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->person_delay . '</p>
            <p class="delay_para_head para_head">Designation Responsible For Delay</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->designation_delay . '</p>
            <p class="delay_para_head para_head">Recovered Amount</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->recover_amount . '</p>
            <p class="delay_para_head para_head">Date Amount Recovered</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_recover_amount . '</p>
            <p class="delay_para_head para_head">Date Deposited To Bank</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_deposite_bank . '</p>
            <p class="delay_para_head para_head">Date of Submited </p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_of_submit . '</p>
            <button id="show_form_document" class="btn btn-primary" value="' . $img_url . '">View Upload Document</button>';
        }
        return $content;
    }
    public static function approvalMethod($table, $form_id, $approval_index, $reason)
    {
        $success = false;
        $today = date('Y-m-d');
        try {
            DB::table($table)
                ->where('district_id', Auth::user()->district)
                ->where('id', $form_id)
                ->update(['approval_status' => $approval_index, 'app_rej_date' => $today, 'remarks' => $reason]);
            $success = true;
        } catch (Exception $e) {
            $success = false;
        }
        return $success;
    }
}
