<?php

namespace App\Http\Controllers;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\MyMethod\DelayEmpForm;
use Illuminate\Support\Facades\Auth;

class DelayConpensationFormListController extends Controller
{
    public function create()
    {
        // Load Delay Form List
        return view('delay_compensation_form_list');
    }
    public function form_list(Request $request)
    {
        // Get All Delay Form List To Datatable 

        if ($request->ajax()) {
            $emp_code = Auth::user()->login_id;
            $delay_form_list_data = DB::table('add_dc')->where('submited_by', $emp_code)->select('id', 'code_number', 'mr_number', 'recover_amount', 'date_of_submit', 'request_id', 'approval_status')->get();
            return response()->json(['message' => $delay_form_list_data]);
        }
    }

    // Display Submited Form Data Using ID And Employe Code 
    // Render From controller To Blade File 
    public function form_list_data(Request $request)
    {
        if ($request->ajax()) {
            $delay_form_id = $_GET['delay_form_id'];
            if (isset($delay_form_id)) {
                $emp_code = Auth::user()->login_id;
                $delay_form_data = DB::table('add_dc')->where('submited_by', $emp_code)->where('id', $delay_form_id)->get();
                if (count($delay_form_data) == 0) {
                    return "<p>No data Found</p>";
                } else {
                    $img_url = Storage::url($delay_form_data[0]->bank_statement_url);
                    $content = '<p class="delay_para_head para_head">Work Code Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->code_number . '</p>
            <p class="delay_para_head para_head">MR Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->mr_number . '</p>
            <p class="delay_para_head para_head">Person Responsible For Delay</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->person_delay . '</p>
            <p class="delay_para_head para_head">Designation Responsible For Delay</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->designation_delay . '</p>
            <p class="delay_para_head para_head">Recovered Amount</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->recover_amount . '</p>
            <p class="delay_para_head para_head">Date Amount Recovered</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_recover_amount . '</p>
            <p class="delay_para_head para_head">Date Deposited To Bank</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_deposite_bank . '</p>
            <p class="delay_para_head para_head">Date of Submited </p>
            <p class="delay_para para_1">' . $delay_form_data[0]->date_of_submit . '</p>
            <button id="show_form_document" class="btn btn-primary" value="' . $img_url . '">View Upload Document</button>';
                    return $content;
                }
            } else {
                return "<p>No data</p>";
            }
        }
        // <img src="' . $img_url . '" class="delay_image modal_image">
    }

    // Fetch Data Dates Wise And Send To Blade File 
    public function search_form_date(Request $request)
    {
        if ($request->ajax()) {
            $form_date = $request->from_date_form;
            $to_date = $request->to_date_form;
            $gp_name = $request->gp_name;
            $result = DelayEmpForm::searchDatesGp($form_date, $to_date, $gp_name, 'add_dc');
            return response()->json(['status' => $result[0], 'message' => $result[1]]);
        }
    }
}
