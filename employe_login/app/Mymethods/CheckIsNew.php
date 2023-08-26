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
}
