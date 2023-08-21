<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveApprovedController extends Controller
{
    public function leave_section_get()
    {
        $approval = DB::table('leave_data')->where('approval_status', NULL)->select('e_id')->get();
        $rejected = DB::table('leave_data')->where('approval_status', 0)->select('e_id')->get();
        $approved = DB::table('leave_data')->where('approval_status', 1)->select('e_id')->get();
        return response()->json(['message' => [$approval, $approved, $rejected]]);
    }
}
