<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use App\Mymethods\RecentData;

class TodayAttendance extends Component
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
    use RecentData;
    public function render()
    {

        date_default_timezone_set('Asia/Kolkata');
        // $today = date("Y-m-d", strtotime('-1 day'));
        $today = date("Y-m-d");
        // $attend_details = DB::table('attendance_login as attend_log')->where('attend_log.e_id', Auth::user()->e_id)->where('attend_log.login_date', $today)
        //     ->join('locations as loc', 'loc.id', '=', 'attend_log.location_id')
        //     ->select(
        //         'attend_log.*',
        //         'loc.office_name as office_name'
        //     )->get();



        $attend_details = $this->getRecentdata($today);
        // $labels = $attend_details->keys();
        $logout_check = null;
        if (count($attend_details) != 0) {
            if ($attend_details[0]->logout_time == null) {
                $logout_check = 'no';
            } else {
                $logout_check = 'yes';
            }
        } else {
            $attend_details = null;
        }
        return view('components.today-attendance', ['attend_details' => $attend_details, 'logout_check' => $logout_check]);
    }
}
