<?php

namespace App\Http\Controllers;

use App\Mymethods\CheckIsNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Parser\Block\BlockContinueParserWithInlinesInterface;

class leaveHistoryController extends Controller
{
    public function leave_history(Request $request)
    {
        if ($request->ajax()) {
            $select_month = $_GET['select_month'];
            $total_day = date('d');
            $current_year = date('Y');
            $days = cal_days_in_month(CAL_GREGORIAN, $select_month, $current_year);
            $all_leave_data = array();
            for ($i = 1; $i <= $days; $i++) {
                $date = date($current_year . '-' . $select_month . '-' . $i);
                $leave_data = CheckIsNew::getLeaveData($date);
                if (count($leave_data) != 0) {
                    array_push($all_leave_data, $leave_data);
                }
            }
            $result = $this->setLeaveHistory($all_leave_data);
            return $result;
        } else {
            return redirect('/home');
        }
    }
    public function leave_history_date(Request $request)
    {
        if ($request->ajax()) {
            $leave_his_date = $_GET['leave_his_date'];
            $all_leave_data = array();
            $date = date($leave_his_date);
            $leave_data = CheckIsNew::getLeaveData($date);
            $result = $this->setLeaveHistoryDate($leave_data);
            return $result;
        } else {
            return redirect('/home');
        }
    }
    public function review_leave_application(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['leave_application_id'];
            $result = CheckIsNew::getLeaveInfo($id);
            if ($result[0]->pay_extra_day === null) {
                $result[0]->pay_extra_day = 'No Extra Days';
            }
            $medical = null;
            if ($result[0]->medical != null) {
                $medical = '<button id="view_medical" value="' . $result[0]->medical . '"> <i class="fa fa-notes-medical"></i> </button>';
            }
            $div_text = '<p class="flex_div review_leave_head"><span>Application 1</span> ' . $medical . ' </p>
            <div class="flex_div review_leave_div_1 review_leave_div_2 review_leave_para_1">
                <p>SI</p>
                <p>Leave Name</p>
            </div>
            <div class="flex_div review_leave_div_1 review_leave_para_2">
                <p>1</p>
                <p>' . $result[0]->leave_name . '</p>
            </div>
            <div class="flex_div review_leave_div_1 review_leave_div_2 review_leave_para_1">
                <p>Form Date</p>
                <p>To Date</p>
            </div>
            <div class="flex_div review_leave_div_1 review_leave_para_2">
                <p>' . $result[0]->form_date . '</p>
                <p>' . $result[0]->to_date . '</p>
            </div>
            <div class="flex_div review_leave_div_1 review_leave_div_2 review_leave_para_1">
                <p>No Days</p>
                <p>Pay Day Extra</p>
            </div>
            <div class="flex_div review_leave_div_1 review_leave_para_2">
                <p>' . $result[0]->no_day . '</p>
                <p>' . $result[0]->pay_extra_day . '</p>
            </div>
            <div class="flex_div review_leave_div_1 review_leave_div_2">
                <p>Day Type</p>
                <p>Leave Reaon</p>
            </div>
            <div class="flex_div review_leave_div_1"> 
            <p>' .  str_replace('_', ' ', $result[0]->day_name)  . '</p>
                <p>' . $result[0]->reason . '</p>
            </div>';
            return [200, $div_text];
        } else {
            return redirect('/home');
        }
    }
    public function remove_leave_application(Request $request)
    {
        if ($request->ajax()) {
            $message = "Ok";
            $status = 200;
            $id = $_GET['leave_application_id'];
            $check_id_data = CheckIsNew::checkLeaveID($id);
            if (count($check_id_data) != 0) {
                $year = date('Y', strtotime($check_id_data[0]->to_date));
                $leave_allocation = DB::table('leave_allocation')->where('e_id', Auth::user()->e_id)->where('leave_id', $check_id_data[0]->leave_id)->where('year', $year)->get();
                if ($check_id_data[0]->status == 0) {
                    $leave_balance = $leave_allocation[0]->leave_balance + $check_id_data[0]->no_day;
                    DB::table('leave_data')->where('id', $id)->delete();
                    DB::table('leave_allocation')->where('e_id', Auth::user()->e_id)->where('leave_id', $check_id_data[0]->leave_id)->where('year', $year)->update(['leave_balance' => $leave_balance]);
                } else if ($check_id_data[0]->status == 1) {
                    DB::table('leave_data')->where('id', $id)->delete();
                    if ($check_id_data[0]->pay_extra_day != $check_id_data[0]->no_day) {
                        $leave_balance = $check_id_data[0]->no_day - $check_id_data[0]->pay_extra_day;
                        DB::table('leave_allocation')->where('e_id', Auth::user()->e_id)->where('leave_id', $check_id_data[0]->leave_id)->where('year', $year)->update(['leave_balance' => $leave_balance]);
                    }
                }
                $message = "Leave Application Removed";
                $status = 200;
            } else {
                $status = 400;
                $message = "Application ID Not Found !";
            }
            return response()->json(['message' => $message, 'status' => $status]);
        } else {
            return redirect('/home');
        }
    }
    public function leave_medical_file(Request $request)
    {
        if ($request->ajax()) {
            $imgURl = Storage::url($_GET['medical_url']);
            return response()->json(['message' => $imgURl]);
        } else {
            return redirect('/home');
        }
    }
    public function setLeaveHistory($all_leave_data)
    {
        $result = array();
        $status = null;
        $message = null;
        if (count($all_leave_data) == 0) {
            $status = 400;
            $message = "Data Not Found !";
            $result = array($status, $message);
        } else {
            $status = 200;
            $count = 1;
            $main_div_text = array();
            foreach ($all_leave_data as $leave_data) {
                foreach ($leave_data as $l_data) {
                    $approval_text = "";
                    if ($l_data->approval_status === null) {
                        $approval_text = "Waiting";
                    } else if ($l_data->approval_status == 1) {
                        $approval_text = "Approved";
                    } else if ($l_data->approval_status == 0) {
                        $approval_text = "Rejected";
                    }
                    $div_text = '<div class="flex_div leave_his_data_div_3"><p class="leave_his_data_para_1 si_para">' . $count . '</p><p class="leave_his_data_para_1 leave_para">' . $l_data->leave_name . '</p><p class="leave_his_data_para_1 from_date">' . $l_data->form_date . '</p><p class="leave_his_data_para_1 to_date">' . $l_data->to_date . '</p><p class="leave_his_data_para_1 status">' . $approval_text . '</p><div class="flex_div actions"><button class="leave_action_btn" id="leave_action_remove" value="' . $l_data->id . '"><i class="fa fa-trash"></i></button><button class="leave_action_btn" id="leave_action_view" value="' . $l_data->id . '"><i class="fa fa-eye"></i></button></div></div>';
                    $count++;
                    array_push($main_div_text, $div_text);
                }
            }
            $result = array($status, $main_div_text, $all_leave_data);
        }
        return $result;
    }
    public function setLeaveHistoryDate($all_leave_data)
    {
        $result = array();
        $status = null;
        $message = null;
        if (count($all_leave_data) == 0) {
            $status = 400;
            $message = "Data Not Found !";
            $result = array($status, $message);
        } else {
            $status = 200;
            $count = 1;
            $main_div_text = array();
            foreach ($all_leave_data as $leave_data) {
                $approval_text = "";
                if ($leave_data->approval_status === null) {
                    $approval_text = "Waiting";
                } else if ($leave_data->approval_status == 1) {
                    $approval_text = "Approved";
                } else if ($leave_data->approval_status == 0) {
                    $approval_text = "Rejected";
                }
                $div_text = '<div class="flex_div leave_his_data_div_3"><p class="leave_his_data_para_1 si_para">' . $count . '</p><p class="leave_his_data_para_1 leave_para">' . $leave_data->leave_name . '</p><p class="leave_his_data_para_1 from_date">' . $leave_data->form_date . '</p><p class="leave_his_data_para_1 to_date">' . $leave_data->to_date . '</p><p class="leave_his_data_para_1 status">' . $approval_text . '</p><div class="flex_div actions"><button class="leave_action_btn" id="leave_action_remove" value="' . $leave_data->id . '"><i class="fa fa-trash"></i></button><button class="leave_action_btn" id="leave_action_view" value="' . $leave_data->id . '"><i class="fa fa-eye"></i></button></div></div>';
                $count++;
                array_push($main_div_text, $div_text);
            }
            $result = array($status, $main_div_text);
        }
        return $result;
    }
}
