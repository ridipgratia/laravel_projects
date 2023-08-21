<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\RedisPubSubHandler;

class AttendanceController extends Controller
{
    public $lat_a = 26.1327768;
    public $long_a = 91.8177791;
    public $lat_b = 26.132705839;
    public $long_b = 91.81780601;

    public function check_login($e_id)
    {
        $today = date("Y-m-d");
        $earthRadius = 6371;
        $lat1 = 26.13273610;
        $lon1 = 91.81773110;
        $lat2 = 26.13276463;
        $lon2 = 91.81775634;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        // dd($distance * 1000);
        $atten_login = DB::table('attendance_login')->where('e_id', $e_id)->where('login_date', $today)->get();
        return $atten_login;
    }
    public function getLocationDiff($lat1, $lon1, $office_lat, $office_long)
    {
        // $lat2 = 26.132764632090147;
        // $lon2 = 91.81775633558229;


        // $lat2 = $office_lat;
        // $lon2 = $office_long;
        // $earthRadius = 6371000;
        // $latDiff = deg2rad($lat2 - $lat1);
        // $lonDiff = deg2rad($lon2 - $lon1);
        // $distance = $earthRadius * sqrt($latDiff * $latDiff + $lonDiff * $lonDiff);
        // $dis_meter = (float)number_format($distance, 3);


        $earthRadius = 6371;
        $dLat = deg2rad($office_lat - $lat1);
        $dLon = deg2rad($office_long - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($office_lat)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        $km = ($distance * 1000);
        return $km;
    }
    public function create()
    {
        $e_id = Auth::user()->e_id;
        $atten_login = $this->check_login($e_id);
        $atten_button = null;
        $atten_button_text = null;
        $locations = DB::table('locations')->get();
        date_default_timezone_set('Asia/Kolkata');
        $today = date("Y-m-d");
        $day = date('l');
        $dt = new DateTime();
        $time = $dt->format('H:i');
        if (count($atten_login) == 1) {
            $atten_button = 'atten_sing_out';
            $atten_button_text = "Sign Out";
        } else {
            $atten_button = 'atten_sign_in';
            $atten_button_text = 'Sign In';
        }
        return view('attendance', ['atten_button' => [$atten_button, $atten_button_text], 'locations' => $locations, 'date' => [$time, $day, $today]]);
    }
    public function store_login(Request $request)
    {
        $e_id = Auth::user()->e_id;
        $check_login = $this->check_login($e_id);
        $status = null;
        if (count($check_login) == 1) {
            return response()->json(['status' => 400, 'message' => 'Already Logged In']);
        } else {
            $reason = null;
            $location_id = $request->location_id;
            $location_details = DB::table('locations')->where('id', $location_id)->get();
            $lat1 = $request->lat_1;
            $lon1 = $request->long_1;
            $reason = $request->reason;
            $today = date("Y-m-d");
            $diff_info = $this->getFinalLocationDiff($lat1, $lon1, $location_details[0]->location_lat, $location_details[0]->location_long);
            $office_time = new DateTime($location_details[0]->office_time);
            $reach_time =  new DateTime($diff_info[1]);
            $str_office_time = strtotime($location_details[0]->office_time);
            $str_reach_time = strtotime($diff_info[1]);
            $str_diff_time = $str_office_time - $str_reach_time;
            // $from_time = new DateTime('19:44');
            // $diff = $to_time->diff($from_time);
            if ($diff_info[0] < 100) {
                if ($str_office_time > $str_reach_time) {
                    $reason = null;
                } else {
                    if (!isset($reason)) {
                        return response()->json(['status' => 400, 'message' => 'Fill Reason  Filled']);
                    }
                }
                DB::table('attendance_login')->insert(['e_id' => $e_id, 'login_date' => $today, 'start_time' => $reach_time, 'start_lat' => $lat1, 'start_long' => $lon1, 'login_location_diff' => $diff_info[0], 'reason' => $reason]);
                return response()->json(['status' => 200, 'message' => 'Attendance Successfully Submited !']);
            } else {
                $status = 400;
                $message = "You Are Not Able To Sign In";
            }
        }
        // return response()->json(['status' => 200, 'message' => [$action_id, $message], 'data' => ['e_id' => $e_id, 'login_date' => $today, 'start_time' => $time, 'start_lat' => $lat1, 'start_long' => $lon1, 'login_location_diff' => $diff_location]]);
    }

    // public function create_location(Request $request)
    // {
    //     $e_id = Auth::user()->e_id;
    //     $check_login = $this->check_login($e_id);
    //     $status = null;
    //     if (count($check_login) == 1) {
    //         return response()->json(['status' => 400, 'message' => 'Already Logged In']);
    //     } else {
    //         $lat1 = (float) $request->lat_1;
    //         $lat1 = (float)number_format($lat1, 7);
    //         $lon1 = (float) $request->long_1;
    //         $lon1 = (float)number_format($lon1, 7);
    //         $diff_location = $this->getLocationDiff($lat1, $lon1);
    //         date_default_timezone_set('Asia/Kolkata');
    //         $dt = new DateTime();
    //         $time = $dt->format('H:i:s');
    //         if ($diff_location < 1000) {
    //             $office_time = strtotime("18:50");
    //             $reach_time = strtotime($time);
    //             $action_id = 'sign_out';
    //             if ($office_time > $reach_time) {
    //                 $display = 'block';
    //             } else {
    //                 $display = 'none';
    //             }
    //             $status = 200;
    //             $message = "Sign In Success !";
    //         } else {
    //             $status = 400;
    //             $message = "You Are Not Able To Sign In";
    //         }
    //     }
    //     return response()->json(['status' => 200, 'display' => $display, 'time' => $time]);
    // }

    public function store_location(Request $request)
    {
        $location_id = $request->location_id;
        $e_id = Auth::user()->e_id;
        if (isset($location_id)) {
            if (count($this->check_login($e_id)) == 1) {
                return response()->json(['status' => 400, 'message' => 'Already You Are Logged In']);
            } else {
                $lat_1 = $request->lat_1;
                $long_1 = $request->long_1;
                $location_details = DB::table('locations')->where('id', $location_id)->get();
                $today = date("Y-m-d");
                $day = date('l');
                $diff_info = $this->getFinalLocationDiff($lat_1, $long_1, $location_details[0]->location_lat, $location_details[0]->location_long);
                $office_time = new DateTime($location_details[0]->office_time);
                $reach_time =  new DateTime($diff_info[1]);
                $str_office_time = strtotime($location_details[0]->office_time);
                $str_reach_time = strtotime($diff_info[1]);
                $str_diff_time = $str_office_time - $str_reach_time;
                $display = null;
                if ($diff_info[0] < 100) {
                    if ($str_office_time > $str_reach_time) {
                        $display = "none";
                        $diff_time_text = '0H : 0M';
                    } else {
                        $display = 'block';
                        $diff_time = $office_time->diff($reach_time);
                        $diff_time_text = $diff_time->h . 'H : ' . $diff_time->i . 'M';
                    }
                    return response()->json(['status' => 200, 'message' => [$diff_info, [$today, $day], $diff_time_text, $location_details[0]->office_name], 'reason' => $display, 'location_id' => $location_id]);
                } else {
                    return response()->json(['status' => 400, 'message' => 'You Are ' . number_format($diff_info[0]) . ' Meters Away From Office !']);
                }
            }
        } else {
            return response()->json(['status' => 400, 'message' => 'Already Sign In ']);
        }
    }
    public function store_login_submit(Request $request)
    {
        $submit = $request->submit;
        return response()->json(['message' => 'Submited']);
    }
    public function getFinalLocationDiff($lat_1, $long_1, $offcie_lat, $office_long)
    {
        $lat1 = (float) $lat_1;
        $lat1 = (float)number_format($lat1, 7);
        $lon1 = (float) $long_1;
        $lon1 = (float)number_format($lon1, 7);
        $diff_location = $this->getLocationDiff($lat1, $lon1, $offcie_lat, $office_long);
        date_default_timezone_set('Asia/Kolkata');
        $dt = new DateTime();
        $time = $dt->format('H:i');
        return [$diff_location, $time];
    }
}
