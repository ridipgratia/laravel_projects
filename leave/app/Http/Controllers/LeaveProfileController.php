<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveProfileController extends Controller
{
    public function leaveProfileShow()
    {
        $type_of_leave = DB::table('type_of_leave')->get();
        $type_of_day = DB::table('type_of_days')->get();
        $leave_allocation = DB::table('leave_day_allocation')->where('e_id', 1)->select('leave_balance')->get();
        return view('leaveProfile', ['type_of_leave' => $type_of_leave, 'type_of_day' => $type_of_day, 'leave_allocation' => $leave_allocation]);
        // 1. When leave_day != extra_days
        // 2. minus leave_day with extra days
        // 3. $leave_data = DB::table('leave_data')->where('e_id', $e_id)->whereColumn('no_day', '!=', 'pay_extra_day')->get();
    }
}
