<?php

namespace App\Http\Controllers;

use App\Models\all_employe_login;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AttendanceController;

class HomeController extends Controller
{
    public function create()
    {
        date_default_timezone_set('Asia/Kolkata');
        $e_id = Auth::user()->e_id;
        $atten_login = AttendanceController::check_login($e_id);
        $atten_button = null;
        $atten_button_text = null;
        $location_submit_btn = null;
        $locations = DB::table('locations')->get();
        date_default_timezone_set('Asia/Kolkata');
        $today = date("Y-m-d");
        $day = date('l');
        $dt = new DateTime();
        $time = $dt->format('H:i');
        if (count($atten_login) == 1) {
            $atten_button = 'atten_sing_out';
            $atten_button_text = "Sign Out";
            $location_submit_btn = "submit_sign_out";
            $re_verify = DB::table('attendance_login')->where('e_id', $e_id)->where('login_date', $today)->select('logout_time')->get();
            if ($re_verify[0]->logout_time != null) {
                $atten_button = "day_over";
                $atten_button_text = "Day Over";
                $location_submit_btn = 'day_over';
            }
        } else {
            $atten_button = 'atten_sign_in';
            $atten_button_text = 'Sign In';
            $location_submit_btn = "submit_sign_in";
        }
        return view('home', ['atten_button' => [$atten_button, $atten_button_text, $location_submit_btn], 'date' => [$time, $day, $today], 'locations' => $locations]);
    }
}
