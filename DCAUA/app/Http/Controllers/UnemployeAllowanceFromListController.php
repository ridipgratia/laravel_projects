<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UnemployeAllowanceFromListController extends Controller
{
    public function create()
    {
        return view('unemp_allowance_form_list');
    }
    public function form_list(Request $request)
    {
        // Get All Delay Form List To Datatable 

        if ($request->ajax()) {
            $emp_code = "emp_code_3";
            $unemp_allow_form_list_data = DB::table('add_unemp_allowance')->where('submited_by', $emp_code)->select('id', 'date_of_submite', 'request_id', 'approval_status')->get();
            return response()->json(['message' => $unemp_allow_form_list_data]);
        }
    }
    // Display Submited Form Data Using ID And Employe Code 
    // Render From controller To Blade File 
    public function form_list_data(Request $request)
    {
        if ($request->ajax()) {
            $delay_form_id = $_GET['unemp_allow_form_id'];
            if (isset($delay_form_id)) {
                $emp_code = "emp_code_3";
                $delay_form_data = DB::table('add_unemp_allowance')->where('submited_by', $emp_code)->where('id', $delay_form_id)->get();
                if (count($delay_form_data) == 0) {
                    return "<p>No data Found</p>";
                } else {
                    $img_url = Storage::url($delay_form_data[0]->bank_statement_url);
                    $content = '<p class="delay_para_head para_head">Work Code Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->card_number . '</p>
            <p class="delay_para_head para_head">MR Number</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->work_demand . '</p>
            <p class="delay_para_head para_head">Total Day of Unemployement</p>
            <p class="delay_para para_1">' . $delay_form_data[0]->total_day_unemple . '</p>
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
            <p class="delay_para para_1">' . $delay_form_data[0]->date_of_submite . '</p>
            <iframe src="' . $img_url . '"  ></iframe>';
                    return $content;
                }
            } else {
                return "<p>No data</p>";
            }
        }
    }
}
