<?php

namespace App\Http\Controllers\district;

use App\Http\Controllers\Controller;
use App\MyMethod\AddUserByState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyMethod\DistrictMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DelayCompensationList extends Controller
{
    public function index()
    {
        return view('district.delay_compensation_list');
    }
    public function form_list(Request $request)
    {
        if ($request->ajax()) {
            $columns = ['code_number', 'mr_number', 'recover_amount'];
            $lists = DistrictMethod::GetFormList('add_dc', 'delay_form_status', $columns);
            return response()->json(['status' => 200, 'message' => $lists]);
        }
    }
    public function form_data(Request $request)
    {
        if ($request->ajax()) {
            $delay_form_id = $_GET['delay_form_id'];
            if (isset($delay_form_id)) {
                $content = DistrictMethod::viewFormData('add_dc', $delay_form_id);
                
            } else {
                $content = "<p>No Data</p>";
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    public function search_data(Request $request)
    {
        if ($request->ajax()) {
            $from_date_form = $request->from_date_form;
            $to_date_form = $request->to_date_form;
            $form_data = DistrictMethod::searchByDate('add_dc', $from_date_form, $to_date_form);
            return response()->json(['status' => $form_data[0], 'message' => $form_data[1]]);
        }
    }
    public function get_gp_by_block(Request $request)
    {
        if ($request->ajax()) {
            $block_id = $_GET['block_id'];
            $gp_names = DistrictMethod::getGpByBlock($block_id);
            $content = "<option disabled selected>Select</option>";
            foreach ($gp_names as $gp_name) {
                $content .= '<option value="' . $gp_name->gram_panchyat_id . '">' . $gp_name->gram_panchyat_name . '</option>';
            }
            return response()->json(['status' => 200, 'message' => $content]);
        }
    }
    public function search_block_gp_dates(Request $request)
    {
        if ($request->ajax()) {
            $form_date = $request->from_date_form;
            $to_date = $request->to_date_form;
            $block_name = $request->block_name;
            $gp_name = $request->gp_name;
            $result = DistrictMethod::searchByBlockGpDates($form_date, $to_date, $block_name, $gp_name, 'add_dc', 'delay_form_status', 1);
            return response()->json(['status' => $result[0], 'message' => $result[1]]);
        }
    }
    public function approval_list()
    {
        return view('district.delay_approval');
    }
    public function load_approval_list()
    {
        $data = DistrictMethod::loadApprovalData('add_dc', 'delay_form_status');
        return response()->json(['status', 200, 'message' => $data]);
    }
    public function view_approval_form(Request $request)
    {
        if ($request->ajax()) {
            if (isset($_GET['delay_form_id'])) {
                $delay_form_id = $_GET['delay_form_id'];
                $main_content = DistrictMethod::viewFormData('add_dc', $delay_form_id);
                $approval_btn = '<div class="d-flex col-12 mt-2 justify-content-around approval_btn_div"><button id="approved_btn" value="' . $delay_form_id . '">Approve</button><button id="reject_btn" value="' . $delay_form_id . '">Reject</button></div>';
                $reason_content = '<div class="flex_div" id="reject_reason_div"><textarea name="aproval_reason" class="col-8" id="aproval_reason"></textarea><button id="reject_reason_submit" value="' . $delay_form_id . '">Submit</button></div>';
                $content = $main_content . $approval_btn . $reason_content;
            } else {
                $content = "<p>No Data</p>";
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
                $reason = $_GET['aproval_reason'];
                $check_reason = true;
                if ($approval_index == 2) {
                    if ($reason === "") {
                        $check_reason = false;
                    }
                } else {
                    $reason = NULL;
                }
                if ($check_reason) {
                    $request_id = DistrictMethod::getRequestID('add_dc', $form_id);
                    if ($request_id) {
                        if (DistrictMethod::approvalMethod('delay_form_status', $request_id[0]->request_id, $approval_index, $reason)) {
                            $status = 200;
                            $message = "Approval Submited";
                        } else {
                            $status = 400;
                            $message = "Try Later , Problem At Database !";
                        }
                    } else {
                        $status = 400;
                        $message = "Form Not Found !";
                    }
                } else {
                    $status = 400;
                    $message = "Please Fill A Reason To Reject Application ";
                }
            } else {
                $status = 400;
                $message = "Try Later !";
            }
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
    public function search_block_gp_dates_pending(Request $request)
    {
        $form_date = $request->from_date_form;
        $to_date = $request->to_date_form;
        $block_name = $request->block_name;
        $gp_name = $request->gp_name;
        $result = DistrictMethod::searchByBlockGpDates($form_date, $to_date, $block_name, $gp_name, 'add_dc', 'delay_form_status', 3);
        return response()->json(['status' => $result[0], 'message' => $result[1]]);
    }
}
