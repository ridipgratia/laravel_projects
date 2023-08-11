<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveApprovedController extends Controller
{
    public function leave_approved_show()
    {
        $leave_data = DB::table('leave_data as l_data')->where('approval_status', 1)->select(
            'l_data.id as id',
            'l_data.e_id as e_id',
            'l_data.leave_id as leave_id',
            'l_data.form_date as form_date',
            'l_data.to_date as to_date',
            'l_data.created_at as created_at',
            'leave_type.leave_name as leave_name',
            'e_data.employe_name as employe_name',
            'e_data.designation_id as designation_id',
            'd_data.designation_name as designation_name'
        )->join(
            'type_of_leave as leave_type',
            'leave_type.id',
            '=',
            'l_data.leave_id'
        )->join(
            'employe_details as e_data',
            'e_data.id',
            '=',
            'l_data.e_id'
        )->join(
            'designations as d_data',
            'e_data.designation_id',
            '=',
            'd_data.id'
        )->orderBy('created_at', 'ASC')->get();
        return view('leave_approved', ['leave_data' => $leave_data]);
    }
    public function leave_section_get()
    {
        $approval = DB::table('leave_data')->where('approval_status', NULL)->select('e_id')->get();
        $rejected = DB::table('leave_data')->where('approval_status', 0)->select('e_id')->get();
        $approved = DB::table('leave_data')->where('approval_status', 1)->select('e_id')->get();
        return response()->json(['message' => [$approval, $approved, $rejected]]);
    }
}
