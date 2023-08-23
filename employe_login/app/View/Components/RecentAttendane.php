<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class RecentAttendane extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        $get_date_data = true;
        $last_day_data = null;
        $check_logout = null;
        while ($get_date_data) {
            $last_date = date('Y-m-d', strtotime('-1 day'));
            $last_day_data = DB::table('attendance_login as attend_log')->where('attend_log.e_id', Auth::user()->e_id)->where('attend_log.login_date', $last_date)
                ->join('locations as loc', 'loc.id', '=', 'attend_log.location_id')
                ->select(
                    'attend_log.*',
                    'loc.office_name as office_name'
                )->get();
            if ($last_day_data[0]->logout_time != null) {
                $check_logout = 'yes';
            }
            if (count($last_day_data) != 0) {
                $get_date_data = false;
                break;
            }
        }
        return view('components.recent-attendane', ['last_day_data' => $last_day_data, 'check_logout' => $check_logout]);
    }
}
