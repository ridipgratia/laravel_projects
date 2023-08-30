<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\Table\Table;

class AdminLeaveController extends Controller
{
    public function admin_leave_show()
    {
        $leave_data = DB::table('leave_data as l_data')->where('l_data.approval_status', NULL)
            ->select(
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
                'all_employe_details as e_data',
                'e_data.id',
                '=',
                'l_data.e_id'
            )->join(
                'designations as d_data',
                'e_data.designation_id',
                '=',
                'd_data.id'
            )->orderBy('created_at', 'ASC')->get();
        return view('admin/admin_leave', ['leave_data' => $leave_data]);
    }
    public function admin_leave_post()
    {
        $emp_id = $_GET['id'];
        $emp_leave_data = DB::table('leave_data as l_data')
            ->join(
                'type_of_leave as leave_type',
                'leave_type.id',
                '=',
                'l_data.leave_id'
            )->join(
                'type_of_days as day_type',
                'l_data.day_id',
                '=',
                'day_type.id'
            )->join(
                'all_employe_details as e_data',
                'e_data.id',
                '=',
                'l_data.e_id'
            )->where('l_data.id', $emp_id)->select(
                'l_data.e_id as e_id',
                'l_data.leave_id as leave_id',
                'l_data.day_id as day_id',
                'l_data.form_date as form_date',
                'l_data.to_date as to_date',
                'l_data.no_day as no_day',
                'l_data.medical as medical',
                'l_data.reason as reason',
                'l_data.pay_extra_day as pay_extra_day',
                'l_data.status as status',
                'leave_type.leave_name as leave_name',
                'day_type.day_name as day_name',
                'l_data.id as id',
                'e_data.employe_name as employe_name'
            )->get();
        $extra_day = null;
        $un_paid = null;
        if ($emp_leave_data[0]->status == 1) {
            if ($emp_leave_data[0]->no_day != $emp_leave_data[0]->pay_extra_day) {
                $un_paid = $emp_leave_data[0]->no_day - $emp_leave_data[0]->pay_extra_day;
                $extra_day = $emp_leave_data[0]->pay_extra_day;
            } else {
                $un_paid = 0;
                $extra_day = $emp_leave_data[0]->pay_extra_day;
            }
        } else {
            $extra_day = 0;
            $un_paid = $emp_leave_data[0]->no_day;
        }
        return response()->json(['status' => 200, 'message' => $emp_leave_data, 'extra_day' => $extra_day, 'un_paid' => $un_paid]);
    }
    public function admin_leave_image_show()
    {
        $imgURl = Storage::url($_GET['url']);
        return response()->json(['message' => $imgURl]);
    }
    public function admin_leave_approval_post(Request $request)
    {
        $id = $request->id;
        $approval_id = $request->approval_id;
        $message = "";
        $status = 0;
        if ($approval_id != 0 and $approval_id != 1) {
            $message = "Some thing is wrong";
            $status = 400;
        } else {
            $emp_data = DB::table('leave_data')->where('id', $id)->get();
            if (count($emp_data) === 0) {
                $message = "Employe Not Found ";
                $status = 400;
            } else {
                if ($approval_id == 0) {
                    // $leave_allocate = DB::table('leave_day_allocation')->where('e_id', $emp_data[0]->e_id)->where('leave_id', $emp_data[0]->leave_id)->get();
                    // $year = date('Y', strtotime($emp_data[0]->to_date));
                    $year = date('Y', strtotime($emp_data[0]->form_date));
                    $leave_allocate = DB::table('leave_allocation')->where('e_id', $emp_data[0]->e_id)->where('leave_id', $emp_data[0]->leave_id)->where('year', $year)->get();
                    if ($emp_data[0]->status == 0) {
                        $leave_balance = $leave_allocate[0]->leave_balance + $emp_data[0]->no_day;
                        DB::table('leave_data')->where('id', $id)->update(['approval_status' => 0]);
                        // DB::table('leave_day_allocation')->where('e_id', $emp_data[0]->e_id)->where('leave_id', $emp_data[0]->leave_id)->where('year', $year)->update(['leave_balance' => $leave_balance]);
                        DB::table('leave_allocation')->where('e_id', $emp_data[0]->e_id)->where('leave_id', $emp_data[0]->leave_id)->where('year', $year)->update(['leave_balance' => $leave_balance]);
                        $status = 200;
                        $message = "Leave Sucessfully Rejected !";
                    } else if ($emp_data[0]->status == 1) {
                        DB::table('leave_data')->where('id', $id)->update(['approval_status' => 0]);
                        if ($emp_data[0]->pay_extra_day != $emp_data[0]->no_day) {
                            $leave_balance = $emp_data[0]->no_day - $emp_data[0]->pay_extra_day;
                            $total_leave_balance = $leave_balance + $leave_allocate[0]->leave_balance;
                            // DB::table('leave_day_allocation')->where('e_id', $emp_data[0]->e_id)->where('leave_id', $emp_data[0]->leave_id)->where('year', $year)->update(['leave_balance' => $total_leave_balance]);
                            DB::table('leave_allocation')->where('e_id', $emp_data[0]->e_id)->where('leave_id', $emp_data[0]->leave_id)->where('year', $year)->update(['leave_balance' => $total_leave_balance]);
                        }
                        $status = 200;
                        $message = "Leave Sucessfully Rejected !";
                    }
                } else if ($approval_id == 1) {
                    DB::table('leave_data')->where('id', $id)->update(['approval_status' => 1]);
                    $status = 200;
                    $message = "Leave Sucessfully Approved";
                }
            }
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
