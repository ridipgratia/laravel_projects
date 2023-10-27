<?php

namespace App\Http\Controllers\district;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MyMethod\DistrictMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UnempAllowance extends Controller
{
    public function index()
    {
        return view('district.unemp_allowance_list');
    }
    public function form_list(Request $request)
    {
        if ($request->ajax()) {
            $columns = ['card_number', 'work_demand', 'recover_amount'];
            $lists = DistrictMethod::GetFormList('add_unemp_allowance', $columns);
            return response()->json(['status' => 200, 'message' => $lists]);
        }
    }
    public function form_data(Request $request)
    {
        if ($request->ajax()) {
            $delay_form_id = $_GET['delay_form_id'];
            if (isset($delay_form_id)) {
                $content = DistrictMethod::unempViewFormData('add_unemp_allowance', $delay_form_id);
            } else {
                $content = "<p>No data</p>";
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    public function search_data(Request $request)
    {
        if ($request->ajax()) {
            $from_date_form = $request->from_date_form;
            $to_date_form = $request->to_date_form;
            $form_data = DistrictMethod::searchByDate('add_unemp_allowance', $from_date_form, $to_date_form);
            return response()->json(['status' => $form_data[0], 'message' => $form_data[1]]);
        }
    }
    public function search_block_gp_dates(Request $request)
    {
        if ($request->ajax()) {
            $form_date = $request->from_date_form;
            $to_date = $request->to_date_form;
            $block_name = $request->block_name;
            $gp_name = $request->gp_name;
            $result = DistrictMethod::searchByBlockGpDates($form_date, $to_date, $block_name, $gp_name, 'add_unemp_allowance');
            return response()->json(['status' => $result[0], 'message' => $result[1]]);
        }
    }
    // View Unemp Allowance Blade File
    public function approval_list()
    {
        return view('district.unemp_approval');
    }
    public function load_approval_list()
    {
        $data = DistrictMethod::loadApprovalData('add_unemp_allowance');
        return response()->json(['status' => 200, 'message' => $data]);
    }
    public function view_approval_form(Request $request)
    {
        if ($request->ajax()) {
            if (isset($_GET['delay_form_id'])) {
                $delay_form_id = $_GET['delay_form_id'];
                $main_content = DistrictMethod::unempViewFormData('add_unemp_allowance', $delay_form_id);
                $approval_btn = '<div class="d-flex col-12 mt-2 justify-content-around approval_btn_div"><button id="approved_btn" value="' . $delay_form_id . '">Approve</button><button id="reject_btn" value="' . $delay_form_id . '">Reject</button></div>';
                $content = $main_content . $approval_btn;
            } else {
                $content = "<p>No data</p>";
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    public function approval_form_data(Request $request)
    {
        if ($request->ajax()) {
            $status = null;
            $message = null;
            if (isset($_GET['form_id']) && isset($_GET['approval_index'])) {
                $form_id = $_GET['form_id'];
                $approval_index = $_GET['approval_index'];
                if (DistrictMethod::approvalMethod('add_unemp_allowance', $form_id, $approval_index)) {
                    $status = 200;
                    $message = "Approval Submited";
                } else {
                    $status = 400;
                    $message = "Try Later , Problem At Database !";
                }
            } else {
                $status = 400;
                $message = "Try Later !";
            }
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
}
