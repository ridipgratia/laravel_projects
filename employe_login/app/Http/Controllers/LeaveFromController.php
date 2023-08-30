<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaveFromController extends Controller
{
    public function leaveFromShow()
    {
        $type_of_leave = DB::table('type_of_leave')->get();
        $type_of_day = DB::table('type_of_days')->get();
        return view('leaveFrom', ['type_of_leave' => $type_of_leave, 'type_of_day' => $type_of_day]);
    }
    public function leaveFromPost_1(Request $request)
    {
        $to_date = $request->to_date;
        $form_date = $request->from_date;
        $leave_id = $request->typeOfLeave;
        $day_id = $request->typeOfDay;
        $file = $request->file('file');
        $reason = $request->reason;
        // $year = date('Y', strtotime($to_date));
        $year = date('Y', strtotime($form_date));
        $check_1 = false;
        $e_id = Auth::user()->e_id;
        $message = "";
        $type = "";
        $check = true;
        if ($leave_id == "Select" || $day_id == "Select" || $to_date == "" || $form_date == "" || empty($reason)) {
            $check = false;
        }
        if ($check) {
            if ($leave_id == 2) {
                if ($request->hasFile('file')) {
                    $extension = ['pdf', 'jpeg', 'jpg', 'png'];
                    if (in_array($file->getClientOriginalExtension(), $extension)) {
                        $file_name = "Something";
                        $check = true;
                    } else {
                        $check = false;
                    }
                } else {
                    $check = false;
                }
            }
            $allocation_day = DB::table('leave_allocation')->where('e_id', $e_id)
                ->where('leave_id', $leave_id)
                ->where('year', $year)
                ->select('leave_allocation', 'leave_balance')
                ->get();
            if (count($allocation_day) == 0) {
                $message = "You Not Abble To Apply Leave This Year";
            } else {
                $leave_bal = $allocation_day[0]->leave_balance;
                $date_1 = new DateTime($request->from_date);
                $date_2 = new DateTime($request->to_date);
                $diff = $date_1->diff($date_2);
                $diff_day = $diff->d + 1;
                if ($day_id == 1) {
                    $diff_day = $diff_day / 2;
                }
                $extra_day = NULL;
                if ($leave_bal >= $diff_day) {
                    $leave_bal = $leave_bal - $diff_day;
                } else {
                    $extra_day = $diff_day - $leave_bal;
                    $leave_bal = 0;
                }
                $file_name = NULL;
                $status = 0;

                if ($extra_day != NULL) {
                    $status = 1;
                }
                if ($check) {
                    if ($leave_id == 2) {
                        $temp = $file->store('public/images/' . strval($e_id));
                        $file_name = $temp;
                    }
                    if ($status == 0) {
                        $message = "Leave Request Submited !";
                        $type = 'success';
                    } else {
                        $message = "Leave Request Submited But <br> <b>You Are Have No Leave Balance</b>";
                        $type = "warning";
                    }
                    DB::table('leave_allocation')->where('e_id', $e_id)->where('leave_id', $leave_id)->where('year', $year)->update(['leave_balance' => $leave_bal]);
                    DB::table('leave_data')->insert(['e_id' => $e_id, 'leave_id' => $leave_id, 'day_id' => $day_id, 'form_date' => $form_date, 'to_date' => $to_date, 'no_day' => $diff_day, 'medical' => $file_name, 'reason' => $reason, 'created_at' => date('Y-m-d H:i:s'), 'update_at' => date('Y-m-d H:i:s'), 'pay_extra_day' => $extra_day, "status" => $status]);
                    return response()->json(['status' => 200, 'message' => $message, 'type' => $type]);
                } else {
                    $message = "Select Medical File Or Format Must Be In PNG,PDF,JPEG,JPG";
                }
            }
        } else {
            $message = "Fill All Necessary Input !";
        }
        return response()->json(['status' => 400, 'message' => $message, 'type' => $type]);
    }
    public function leave_fun(Request $request)
    {
        return response()->json(['message' => 'Ok']);
    }
}
