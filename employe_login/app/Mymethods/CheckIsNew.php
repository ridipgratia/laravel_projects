<?php

namespace App\Mymethods;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckIsNew
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
    public static function check_date_available($date)
    {
        $check_date = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)->where('login_date', $date)->get();
        if (count($check_date) == 1) {
            return true;
        } else {
            return false;
        }
    }
    public static function getLeaveData($date)
    {
        $leave_data = DB::table('leave_data as l_data')->where('e_id', Auth::user()->e_id)->where('form_date', $date)
            ->join('type_of_leave as leave_t', 'l_data.leave_id', '=', 'leave_t.id')
            ->select(
                'l_data.*',
                'leave_t.leave_name as leave_name',
            )
            ->get();
        return $leave_data;
    }
    public static function getLeaveInfo($id)
    {
        $leave_data = DB::table('leave_data as l_data')->where('l_data.e_id', Auth::user()->e_id)->where('l_data.id', $id)
            ->join('type_of_leave as leave_t', 'l_data.leave_id', '=', 'leave_t.id')
            ->join('type_of_days as leave_d', 'l_data.day_id', '=', 'leave_d.id')
            ->select(
                'l_data.*',
                'leave_t.leave_name as leave_name',
                'leave_d.day_name as day_name'
            )->get();
        return $leave_data;
    }
    public static function checkLeaveID($id)
    {
        $check_id = DB::table('leave_data as l_data')->where('l_data.e_id', Auth::user()->e_id)->where('l_data.id', $id)->get();
        return $check_id;
    }
}
