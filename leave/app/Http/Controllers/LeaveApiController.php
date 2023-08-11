<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveApiController extends Controller
{
    public function leave_get()
    {
        $leave_data = DB::table('leave_data')->get();
        return response()->json(['message' => $leave_data]);
    }
    public function leave_post(Request $request)
    {
        $to_date = new DateTime($request->to_date);
        $form_date = new DateTime($request->form_date);
        $diff = $to_date->diff($form_date);
        // $form_date = $request->from_date;
        $leave_id = $request->typeOfLeave;
        $day_id = $request->typeOfDay;
        // $file = $request->file('file');
        $reason = $request->reason;
        return response()->json(['message' => $diff->d], 201);
    }
}
