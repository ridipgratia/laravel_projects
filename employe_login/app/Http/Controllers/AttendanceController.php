<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\RedisPubSubHandler;

use function PHPSTORM_META\type;
use App\Mymethods\RecentData;
use App\Mymethods\CheckIsNew;
use DateInterval;
use DatePeriod;

class AttendanceController extends Controller
{
    public $lat_a = 26.1327768;
    public $long_a = 91.8177791;
    public $lat_b = 26.132705839;
    public $long_b = 91.81780601;
    use RecentData;
    public static function check_login($e_id)
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
        $atten_login = array();
        if (CheckIsNew::check_is_new()) {
            $atten_login = DB::table('attendance_login')->where('e_id', $e_id)->where('login_date', $today)->get();
        }

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
        // $total_days = cal_days_in_month(CAL_GREGORIAN, 1, 2023);

        $dates = array();
        $the_date = date('d');
        $the_date = (int)$the_date;
        $month = (int)date('m');
        $str_month = date('M');
        $year = 2023;
        if ($this->check_is_new(Auth::user()->e_id)) {
            for ($i = 1; $i <= $the_date; $i++) {
                $date = date($year . '-' . $month . '-' . $i);
                // array_push($dates, getdate(strtotime($date)));
                $get_date = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)->where('login_date', $date)->get();
                // array_push($dates, $date);
                if (count($get_date) != 0) {
                    array_push($dates, $get_date);
                }
            }
        }
        $present = (count($dates) / $the_date) * 100;
        $absent = (float) 100 - $present;
        return view('attendance',  ['attend_chart' => [$present, $absent, $str_month, $the_date]]);
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
                DB::table('attendance_login')->insert(['e_id' => $e_id, 'login_date' => $today, 'login_time' => $reach_time, 'login_lat' => $lat1, 'login_long' => $lon1, 'login_location_diff' => $diff_info[0], 'reason' => $reason, 'location_id' => $location_id]);
                return response()->json(['status' => 200, 'message' => 'Attendance Successfully Submited !']);
            } else {
                $status = 400;
                $message = "You Are Not Able To Sign In";
            }
        }
        // return response()->json(['status' => 200, 'message' => [$action_id, $message], 'data' => ['e_id' => $e_id, 'login_date' => $today, 'login_time' => $time, 'login_lat' => $lat1, 'login_long' => $lon1, 'login_location_diff' => $diff_location]]);
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
    public function logout_store_location(Request $request)
    {
        $location_id = $request->location_id;
        $e_id = Auth::user()->e_id;
        if (isset($location_id)) {
            if (count($this->check_login($e_id)) == 0) {
                return response()->json(['status' => 400, 'message' => 'You Are Not Login !']);
            } else {
                $lat_1 = $request->lat_1;
                $long_1 = $request->long_1;
                $location_details = DB::table('locations')->where('id', $location_id)->get();
                $today = date("Y-m-d");
                $day = date('l');
                $diff_info = $this->getFinalLocationDiff($lat_1, $long_1, $location_details[0]->location_lat, $location_details[0]->location_long);
                if ($diff_info[0] < 100) {
                    return response()->json(['status' => 200, 'message' => [$diff_info, [$today, $day], $location_details[0]->office_name], 'location_id' => $location_id]);
                } else {
                    return response()->json(['status' => 400, 'message' => 'You Are ' . number_format($diff_info[0]) . ' Meters Away From Office !']);
                }
            }
        } else {
            return response()->json(['status' => 400, 'message' => 'Already Sign In ']);
        }
    }
    public function store_logout(Request $request)
    {
        $e_id = Auth::user()->e_id;
        $check_login = $this->check_login($e_id);
        $status = null;
        if (count($check_login) == 0) {
            return response()->json(['status' => 400, 'message' => 'You Are Not Login !']);
        } else {
            $reason = null;
            $location_id = $request->location_id;
            $location_details = DB::table('locations')->where('id', $location_id)->get();
            $lat1 = $request->lat_1;
            $lon1 = $request->long_1;
            $today = date("Y-m-d");
            $diff_info = $this->getFinalLocationDiff($lat1, $lon1, $location_details[0]->location_lat, $location_details[0]->location_long);
            $reach_time =  new DateTime($diff_info[1]);
            $str_reach_time = strtotime($diff_info[1]);
            $login_details = DB::table('attendance_login')->where('e_id', $e_id)->where('login_date', $today)->get();
            $forward_time = strtotime($login_details[0]->login_time) + (240 * 60);
            $forward_time_1 = date("H:i", $forward_time);
            $check_time = null;
            if (strtotime($forward_time_1) < $str_reach_time) {
                $check_time = "Big";
            }
            if ($check_time == null) {
                return response()->json(['status' => 400, 'message' => 'You must be work atleast 4 hours. ']);
            }
            if ($diff_info[0] < 100) {
                // DB::table('attendance_login')->insert(['e_id' => $e_id, 'login_date' => $today, 'login_time' => $reach_time, 'login_lat' => $lat1, 'login_long' => $lon1, 'login_location_diff' => $diff_info[0], 'reason' => $reason, 'location_id' => $location_id]);
                DB::table('attendance_login')->where('e_id', $e_id)->where('login_date', $today)->update([
                    'logout_time' => $reach_time,
                    'logout_lat' => $lat1,
                    'logout_long' => $lon1,
                    'logout_diff' => $diff_info[0],
                    'logout_location_id' => $location_id
                ]);
                return response()->json(['status' => 200, 'message' => 'Successfully Logout !']);
            } else {
                $status = 400;
                $message = "You Are Not Able To Sign In";
            }
        }
    }
    public function recent_date()
    {
        if (isset($_GET['recent_date'])) {
            $recent_date = $_GET['recent_date'];
            $recent_date = strtotime($_GET['recent_date']);
            $recent_date = date('Y-m-d', $recent_date);
            // $recent_data = DB::table('attendance_login as attend_login')->where('attend_login.e_id', Auth::user()->e_id)->where('attend_login.login_date', $recent_date)
            //     ->join('locations as loc', 'loc.id', '=', 'attend_login.location_id')
            //     ->select(
            //         'attend_login.*',
            //         'loc.office_name as office_name'
            //     )->get();
            $recent_data = $this->getRecentData($recent_date);
            sleep(1);
            if (count($recent_data) == 0) {
                return response()->json(['status' => 400, 'message' => 'No Attendance Data Found ! ']);
            } else {
                return response()->json(['status' => 200, 'recent_data' => $recent_data]);
            }
        } else {
            return redirect('/attendance');
        }
    }
    public function attend_his()
    {
        $his_from = $_GET['his_from'];
        $his_to = $_GET['his_to'];
        $message = null;
        $status = null;

        // Old Code 
        if ($his_from != "" && $his_to != "") {
            if ($his_from <= $his_to) {
                $from_to_date = array();
                $period = new DatePeriod(
                    new DateTime($his_from),
                    new DateInterval('P1D'),
                    new DateTime($his_to)
                );
                foreach ($period as $key => $value) {
                    array_push($from_to_date, $value->format('Y-m-d'));
                }
                $date_one = date($his_to, strtotime('+1 day'));
                array_push($from_to_date, $date_one);


                $attend_his_data = array();
                foreach ($from_to_date as $dates) {
                    if (CheckIsNew::check_date_available($dates)) {
                        $attend_his = $this->getRecentData($dates);
                        array_push($attend_his_data, $attend_his);
                    }
                }
                $status = 200;
                $message = $attend_his_data;
            } else {
                $status = 400;
                $message = "Select A Validate Date";
            }
        } else {
            $message = "Select From And To Date !";
            $status = 400;
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
    public function store_login_submit(Request $request)
    {
        $submit = $request->submit;
        return response()->json(['message' => 'Submited']);
    }
    public static function check_attend_his($date)
    {
        $check_attend_login = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)
            ->where('login_date', $date)->get();
        if (count($check_attend_login) == 0) {
            return false;
        } else {
            return true;
        }
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
