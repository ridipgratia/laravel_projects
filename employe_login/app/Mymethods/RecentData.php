<?php

namespace App\Mymethods;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


trait RecentData
{
    protected function check_is_new($e_id)
    {
        $is_emp_new = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)->first();
        if ($is_emp_new == null) {
            return false;
        } else {
            return true;
        }
    }
    protected function getRecentData($today)
    {
        $attend_details = DB::table('attendance_login as attend_log')->where('attend_log.e_id', Auth::user()->e_id)->where('attend_log.login_date', $today)
            ->join('locations as loc', 'loc.id', '=', 'attend_log.location_id')
            ->select(
                'attend_log.id as id',
                'e_id',
                'login_date',
                'login_time',
                'login_location_diff',
                'reason',
                'logout_time',
                'logout_diff',
                'loc.office_name as office_name',
            )->get();
        foreach ($attend_details as $emp_attend) {
            if ($emp_attend->logout_time != null) {
                $attend_logout = DB::table('attendance_login as attend')->where('attend.e_id', Auth::user()->e_id)
                    ->where('attend.id', $emp_attend->id)
                    ->join('locations as loc', 'loc.id', '=', 'attend.logout_location_id')
                    ->select('loc.office_name as office_name')
                    ->get();
                $emp_attend->logout_location = $attend_logout[0]->office_name;
            }
        }
        return $attend_details;
    }
}

class RecentDataClass
{
    public static function check_is_new()
    {
        $is_emp_new = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)->first();
        if ($is_emp_new == null) {
            return false;
        } else {
            return true;
        }
    }
}
trait RecentData_1
{
    function show_test_1()
    {
        return 'Method Work';
    }
}
