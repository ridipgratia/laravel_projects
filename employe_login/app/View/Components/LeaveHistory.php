<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use App\Mymethods\CheckIsNew;

class LeaveHistory extends Component
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
        $the_month = date('m');
        $total_day = date('d');
        $current_year = date('Y');
        $days = cal_days_in_month(CAL_GREGORIAN, $the_month, $current_year);
        $all_leave_data = array();
        for ($i = 1; $i <= $days; $i++) {
            $date = date($current_year . '-' . $the_month . '-' . $i);
            $leave_data = CheckIsNew::getLeaveData($date);
            if (count($leave_data) != 0) {
                array_push($all_leave_data, $leave_data);
            }
        }
        return view('components.leave-history', ['current_month' => $the_month, 'all_leave_data' => $all_leave_data]);
    }
}
