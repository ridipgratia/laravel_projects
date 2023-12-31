<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use App\Mymethods\RecentData;

class RecentAttendane extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    use RecentData;
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        date_default_timezone_set('Asia/Kolkata');
        $last_day_data = null;
        $check_logout = null;
        // $is_emp_new = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)->first();
        $is_emp_new = null;
        if ($this->check_is_new(Auth::user()->e_id)) {
            $today = date("Y-m-d");
            if ($this->check_only_one($today)) {
                $last_dates = array();
                $the_date = date('d');
                $the_date = (int)$the_date;
                $month = (int)date('m');
                $str_month = date('M');
                $year = 2023;
                for ($i = 1; $i <= $the_date; $i++) {
                    $date = date($year . '-' . $month . '-' . $i);
                    array_push($last_dates, $date);
                }
                $last_dates_len = count($last_dates);
                $i = 1;
                while ($last_dates_len != 0) {
                    $last_date = date('Y-m-d', strtotime('-' . strval($i) . ' day'));
                    $last_day_data = $this->getRecentData($last_date);
                    if (count($last_day_data) != 0) {
                        if ($last_day_data[0]->logout_time != null) {
                            $check_logout = 'yes';
                        }
                        $is_emp_new = "no";
                        break;
                    }
                    $i++;
                    $last_dates_len--;
                }
                // while ($get_date_data) {
                //     $last_day_data = DB::table('attendance_login as attend_log')->where('attend_log.e_id', Auth::user()->e_id)->where('attend_log.login_date', $last_date)
                //         ->join('locations as loc', 'loc.id', '=', 'attend_log.location_id')
                //         ->select(
                //             'attend_log.*',
                //             'loc.office_name as office_name'
                //         )->get();
                // }
            }
        }
        return view('components.recent-attendane', ['last_day_data' => $last_day_data, 'check_logout' => $check_logout, 'is_emp_new' => $is_emp_new]);
    }
    public function check_only_one($today)
    {
        $attend_only_data = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)->orderBy('login_date', 'ASC')->first();
        $attend_only_data = DB::table('attendance_login')->where('e_id', Auth::user()->e_id)->first();
        if ($today == $attend_only_data->login_date) {
            return false;
        } else {
            return true;
        }
    }
}
