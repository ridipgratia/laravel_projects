<?php

namespace App\MyMethod;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictMethod
{
    public static function GetFormList($table)
    {
        $district_code = Auth::user()->district;
        $lists = DB::table($table)->where('district_id', $district_code)->select('id', 'request_id', 'date_of_submit', 'approval_status')->get();
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
}
