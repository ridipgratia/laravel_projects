<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class leaveFromController extends Controller
{
    public function leaveFromShow()
    {
        $type_of_leave = DB::table('type_of_leave')->get();
        $type_of_day = DB::table('type_of_days')->get();
        return view('leaveFrom', ['type_of_leave' => $type_of_leave, 'type_of_day' => $type_of_day]);
    }
    public function leaveFromPost(Request $request)
    {
        $to_date = $request->to_date;
        $form_date = $request->from_date;
        $leave_id = $request->typeOfLeave;
        $day_id = $request->typeOfDay;
        $file = $request->file('file');
        $reason = $request->reason;
        $year = date('Y', strtotime($to_date));
        $check_1 = false;
        $e_id = 4;
        $message = "";
        $type = "";
        $check = true;
        if ($leave_id == "Select" || $day_id == "Select" || $to_date == "" || $form_date == "" || empty($reason)) {
            $check = true;
        }
        if ($check) {
            // $leave_data = DB::table('leave_data')->where('e_id', $e_id)->where('leave_id', $leave_id)->select('no_day')->get();

            $leave_data = DB::table('leave_data')->where('e_id', $e_id)->where('leave_id', $leave_id)->where('approval_status', NULL)->orWhere('approval_status', 1)->select('no_day')->get();
            $remaining_days = 0;
            $extra_day = NULL;
            foreach ($leave_data as $data) {
                $remaining_days = $remaining_days + $data->no_day;
            }
            $extra_day = $remaining_days - 12;
            $no_day = 0;
            foreach ($leave_data as $data) {
                $no_day = $data->no_day + $no_day;
            }
            $date_1 = new DateTime($request->to_date);
            $date_2 = new DateTime($request->from_date);
            $diff = $date_1->diff($date_2);
            $diff_day = $diff->d + 1;
            if ($day_id == 1) {
                $diff_day = $diff_day / 2;
            }
            $no_day = $no_day + $diff_day;
            $leave_type = DB::table('type_of_leave')->where('id', $leave_id)->select('day_on_leave')->get();
            $remain_day = $leave_type[0]->day_on_leave - $remaining_days;
            // $pay_extra_day = NULL;
            $file_name = NULL;
            $status = 0;
            if ($request->hasFile('file')) {
                $extension = ['pdf', 'jpeg', 'jpg', 'png'];
                if (in_array($file->getClientOriginalExtension(), $extension)) {
                    $file_name = "Something";
                    $check = true;
                } else {
                    $check = false;
                }
            }
            // if ($leave_type[0]->day_on_leave < $no_day) {
            //     $pay_extra_day = $no_day - $leave_type[0]->day_on_leave;
            //     $status = 1;
            // }
            if ($check) {
                if ($file_name != NUll) {
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
                // DB::table('leave_data')->insert(['e_id' => $e_id, 'leave_id' => $leave_id, 'day_id' => $day_id, 'to_date' => $to_date, 'form_date' => $form_date, 'no_day' => $diff_day, 'medical' => $file_name, 'reason' => $reason, 'created_at' => date('Y-m-d H:i:s'), 'update_at' => date('Y-m-d H:i:s'), 'pay_extra_day' => $pay_extra_day, "status" => $status]);
                // return response()->json(['status' => 200, 'message' => $message, 'type' => $type]);
            } else {
                $message = "Select File Format Only PNG,PDF,JPEG,JPG";
            }
        } else {
            $message = "Fill All Necessary Input !";
        }
        // return response()->json(['status' => 400, 'message' => $message, 'type' => $type]);
        return response()->json(['message' => array($extra_day, $remain_day, $diff_day)]);
    }

    public function leaveFromPost_1(Request $request)
    {
        $to_date = $request->to_date;
        $form_date = $request->from_date;
        $leave_id = $request->typeOfLeave;
        $day_id = $request->typeOfDay;
        $file = $request->file('file');
        $reason = $request->reason;
        $year = date('Y', strtotime($to_date));
        $check_1 = false;
        $e_id = 1;
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
            $allocation_day = DB::table('leave_day_allocation')->where('e_id', $e_id)
                ->where('leave_id', $leave_id)
                ->where('year', $year)
                ->select('leave_allocate', 'leave_balance')
                ->get();
            // $leave_data = DB::table('leave_data')->where('e_id', $e_id)->where('leave_id', $leave_id)->select('no_day')->get();


            // $leave_data = DB::table('leave_data')->where('e_id', $e_id)->where('leave_id', $leave_id)->where('approval_status', NULL)->orWhere('approval_status', 1)->select('no_day')->get();
            // $remaining_days = NUll;
            // $extra_day = NULL;
            // foreach ($leave_data as $data) {
            //     $remaining_days = $remaining_days + $data->no_day;
            // }
            // $extra_day = $remaining_days - 12;

            // $no_day = 0;
            // foreach ($leave_data as $data) {
            //     $no_day = $data->no_day + $no_day;
            // }

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
                DB::table('leave_day_allocation')->where('e_id', $e_id)->where('leave_id', $leave_id)->update(['leave_balance' => $leave_bal]);
                DB::table('leave_data')->insert(['e_id' => $e_id, 'leave_id' => $leave_id, 'day_id' => $day_id, 'form_date' => $form_date, 'to_date' => $to_date, 'no_day' => $diff_day, 'medical' => $file_name, 'reason' => $reason, 'created_at' => date('Y-m-d H:i:s'), 'update_at' => date('Y-m-d H:i:s'), 'pay_extra_day' => $extra_day, "status" => $status]);
                return response()->json(['status' => 200, 'message' => $message, 'type' => $type]);
            } else {
                $message = "Select Medical File Or Format Must Be In PNG,PDF,JPEG,JPG";
            }
        } else {
            $message = "Fill All Necessary Input !";
        }
        return response()->json(['status' => 400, 'message' => $message, 'type' => $type]);
        // return response()->json(['message' => array($extra_day, $leave_bal,  $diff_day)]);
    }
}
