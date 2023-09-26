<?php

namespace App\Http\Controllers;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\MyMethod\DelayEmpForm;

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
            $emp_code = "emp_code_4";
            $delay_form_list_data = DB::table('add_dc')->where('submited_by', $emp_code)->select('id', 'date_of_submit', 'request_id', 'approval_status')->get();
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
                $emp_code = "emp_code_4";
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
            $message = null;
            $status = null;
            if ($form_date == null || $to_date == "") {
                $status = 400;
                $message = "Please Select Form Submission dates ";
            } else {
                if ($form_date <= $to_date) {
                    $period = new DatePeriod(
                        new DateTime($form_date),
                        new DateInterval('P1D'),
                        new DateTime($to_date)
                    );
                    $form_to_date = array();
                    foreach ($period as $key => $value) {
                        array_push($form_to_date, $value->format('Y-m-d'));
                    }
                    $date_one = date($to_date, strtotime('+1 day'));
                    array_push($form_to_date, $date_one);
                    $form_date_his = array();
                    foreach ($form_to_date as $dates) {
                        if (DelayEmpForm::checkIsDateAvai($dates, 'add_dc')) {
                            $form_data = DelayEmpForm::getFromdata($dates, 'add_dc');
                            array_push($form_date_his, $form_data);
                        }
                    }
                    $message = $form_date_his;
                    $status = 200;
                } else {
                    $message = "Select Valid Dates ";
                    $status = 400;
                }
            }
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
}
