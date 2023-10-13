<?php

namespace App\MyMethod;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictMethod
{
    public static function GetFormList($table, $columns)
    {
        $district_code = Auth::user()->district;
        $lists = DB::table($table)->where('district_id', $district_code)->select('id', $columns[0], $columns[1], $columns[2], 'request_id', 'date_of_submit', 'approval_status')->get();
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
    public static function searchByBlockGpDates($form_date, $to_date, $block_name, $gp_name, $table)
    {
        $status = null;
        $message = null;
        if ($form_date === null && $to_date === null && $block_name === null && $gp_name === null) {
            $status = 200;
            $result = DB::table($table)
                ->where('district_id', Auth::user()->district)
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
                                $form_data = DB::table($table)
                                    ->where('date_of_submit', $dates)
                                    ->where('gp_id', $gp_name)
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
                                    $form_data = DB::table($table)
                                        ->where('block_id', $block_name)
                                        ->where('date_of_submit', $dates)
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
                                $result = DB::table($table)
                                    ->where('block_id', $block_name)
                                    ->where('gp_id', $gp_name)
                                    ->get();
                                $message = array($result);
                            } else {
                                $result = DB::table($table)
                                    ->where('block_id', $block_name)
                                    ->get();
                                $message = array($result);
                            }
                            $status = 200;
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
}
