<?php

namespace App\MyMethod;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class DelayEmpForm
{
    // To Check Is Date Exists Or Not 
    public static function checkIsDateAvai($date, $table)
    {
        $check_date = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('date_of_submit', $date)->get();
        if (count($check_date) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // To Get Data Date Wise 
    public static function getFromdata($date, $table)
    {
        $form_data = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('date_of_submit', $date)->get();
        return $form_data;
    }
    // get Approval data
    public static function getApproaveData($table)
    {
        $form_list = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('approval_status', 1)->select('id', 'request_id', 'date_of_submit')->get();
        return $form_list;
    }
    // Check Is FTO No Exists 
    public static function checkIsFTO($table, $form_id)
    {
        $FTO_lists = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('form_id', $form_id)->select('id')->get();
        if (count($FTO_lists) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // Check Form ID Avaible Or Not 
    public static function checkFormIDAvai($table, $form_id)
    {
        $check_form_id = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('id', $form_id)->select('id')->get();
        if (count($check_form_id) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // Check Approval Status Of Form ID
    public static function checkApprovalStatus($table, $form_id)
    {
        $check_approval = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('id', $form_id)->where('approval_status', 1)->select('id')->get();
        if (count($check_approval) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // Get FTO Number 
    public static function getFTOData($table, $form_id)
    {
        $get_FTO_data = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('form_id', $form_id)->get();
        return $get_FTO_data;
    }
    //  Get District Name
    public static function getDistrictName($district_code)
    {
        $district_name = DB::table('districts')->where('district_code', $district_code)->select('district_name')->get();
        return $district_name[0]->district_name;
    }
    // Get Block Name
    public static function getBlockName($block_id)
    {
        $block_name = DB::table('blocks')->where('block_id', $block_id)->select('block_name')->get();
        return $block_name[0]->block_name;
    }
    // get GP Names
    public static function getGPName($block_id)
    {
        $gp_names = DB::table('gram_panchyats')->where('block_id', $block_id)->select('gram_panchyat_id', 'gram_panchyat_name')->get();
        return $gp_names;
    }
    // Search By Dates And Gp Name 
    public static function searchDatesGp($form_date, $to_date, $gp_name, $table)
    {
        $status = null;
        $message = null;
        if ($form_date === null && $to_date === null && $gp_name === null) {
            $status = 200;
            $result = DB::table($table)->where('submited_by', Auth::user()->login_id)->get();
            $message = array($result);
        } else {
            if (($form_date === null && $to_date !== null) || ($form_date !== null && $to_date === null)) {
                $status = 400;
                $message = "Select Both Dates ";
            } else {
                if ($form_date !== null && $gp_name !== null) {
                    if ($form_date <= $to_date) {
                        $form_to_date = DelayEmpForm::getPeriodDates($form_date, $to_date);
                        $form_date_his = array();
                        foreach ($form_to_date as $dates) {
                            if (DelayEmpForm::checkIsDateAvai($dates, $table)) {
                                $form_data = DelayEmpForm::getFilterData($dates, $table, $gp_name);
                                array_push($form_date_his, $form_data);
                            }
                        }
                        $status = 200;
                        $message = $form_date_his;
                    } else {
                        $status = 400;
                        $message = "Select A Valid dates";
                    }
                } else {
                    if ($gp_name !== null) {
                        $result = DB::table($table)->where('submited_by', Auth::user()->login_id)->where('gp_id', $gp_name)->get();
                        $status = 200;
                        $message = array($result);
                    } else {
                        if ($form_date !== null) {
                            if ($form_date <= $to_date) {
                                $form_to_date = DelayEmpForm::getPeriodDates($form_date, $to_date);
                                $form_date_his = array();
                                foreach ($form_to_date as $dates) {
                                    if (DelayEmpForm::checkIsDateAvai($dates, $table)) {
                                        $form_data = DelayEmpForm::getFromdata($dates, $table);
                                        array_push($form_date_his, $form_data);
                                    }
                                }
                                $status = 200;
                                $message = $form_date_his;
                            } else {
                                $status = 400;
                                $message = "Select A Valid Dates ";
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
    // get Filter Data By Dates And Gp
    public static function getFilterData($date, $table, $gp_code)
    {
        $result = DB::table($table)
            ->where('submited_by', Auth::user()->login_id)
            ->where('date_of_submit', $date)
            ->where('gp_id', $gp_code)
            ->get();
        return $result;
    }

    // Check Form Pending
    public static function checkFormPending($table)
    {
        $form_list = DB::table($table)
            ->where('approval_status', '<>', 3)
            ->count();
        if ($form_list == 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function chekcFormStatus($table, $register_id)
    {
        $state_icon = ['<i class="fa-solid fa-hourglass-half"></i>', '<i class="fa-solid fa-hourglass-half"></i>'];
        $edit_btn = ['', ''];
        $progress_div = "";
        $form_data = DB::table($table)
            ->where('form_request_id', $register_id)
            ->get();

        if (count($form_data) != 0) {
            if ($form_data[0]->district_approval == 1 || $form_data[0]->district_approval == 2 || $form_data[0]->district_approval == 3) {
                if ($form_data[0]->district_approval == 2) {
                    $state_icon[0] = '<i class="fa-solid fa-xmark"></i>';
                } else if ($form_data[0]->district_approval == 3) {
                    $state_icon[0] = '<i class="fa-solid fa-check"></i>';
                }
                if ($form_data[0]->district_approval == 2) {
                    $edit_btn[0] = '<button class="form_edit_btn"><i class="fa-solid fa-pen-to-square"></i></button>';
                }
            }
            if ($form_data[0]->state_approval == 1 || $form_data[0]->state_approval == 2 || $form_data[0]->state_approval == 3) {
                if ($form_data[0]->state_approval == 2) {
                    $state_icon[1] = '<i class="fa-solid fa-xmark"></i>';
                } else if ($form_data[0]->state_approval == 3) {
                    $state_icon[1] = '<i class="fa-solid fa-check"></i>';
                }
                if ($form_data[0]->state_approval == 2) {
                    $edit_btn[1] = '<button class="form_edit_btn"><i class="fa-solid fa-pen-to-square"></i></button>';
                }
            }
            $progress_div = '<div class="flex_div main_progress_div">
            <div class="flex_div progres_div">
                <p>Level</p>
                <p>Status</p>
                <p>Reason</p>
            </div>
            <div class="flex_div progres_div_1">
                <p>District</p>
                <div class="flex_div progres_div_2">
                    <p>' . $state_icon[0] . '</p>
                </div>
                <p>' . $form_data[0]->district_remarks . '</p>' . $edit_btn[0] . '
            </div>
            <div class="flex_div progres_div_1">
                <p>State</p>
                <div class="flex_div progres_div_2">
                    <p>' . $state_icon[1] . '</p>
                </div>
                <p>' . $form_data[0]->state_remarks . '</p>' . $edit_btn[1] . '
            </div>
        </div>';
        }
        return $progress_div;
    }
}
