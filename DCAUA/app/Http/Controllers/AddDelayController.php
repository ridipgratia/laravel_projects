<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AddDelayController extends Controller
{
    public function index()
    {
        // Load Delay Copensation Page

        return view('add_delay_form');
    }
    public function create(Request $request)
    {

        // Form Submite Code For Delay Compensation 


        if ($request->ajax()) {
            $code_number = $request->code_number;
            $mr_number = $request->mr_number;
            $person_delay = $request->person_delay;
            $designation_delay = $request->designation_delay;
            $recover_amount = $request->recover_amount;
            $date_recover_amount = $request->date_recover_amount;
            $date_deposite_bank = $request->date_deposite_bank;
            $bank_statement_url = $request->file('bank_statement');
            $emp_code = "emp_code_4";
            $status = null;
            $message = null;

            $error_message = [
                'required' => 'Fill Your Basic Details',
                'mimes' => 'Select Only PDF'
            ];
            $validator = Validator::make(
                $request->all(),
                [
                    'code_number' => 'required',
                    'mr_number' => 'required',
                    'person_delay' => 'required',
                    'designation_delay' => 'required',
                    'recover_amount' => 'required',
                    'date_recover_amount' => 'required',
                    'date_deposite_bank' => 'required',
                    'bank_statement' => 'required|mimes:pdf',
                ],
                $error_message,
            );
            if ($validator->fails()) {
                $status = 400;
                $message = $error_message['required'];
            } else {
                date_default_timezone_set('Asia/Kolkata');
                $submited_date = date("Y-m-d");
                $submited_year = date('Y');
                $submited_month = date('m');
                $last_id = DB::table('add_dc')->orderBy('id', 'desc')->first();
                if ($last_id == null) {
                    $last_id = 1;
                } else {
                    $last_id = $last_id->id + 1;
                }
                $request_id = "DC" . '/' . $submited_year . '/' . $emp_code . '/' . $last_id;
                $check_error = false;
                $message = $request_id;
                $temp_bank_statement_url = null;
                try {
                    $temp_bank_statement_url = $bank_statement_url->store('public/images/' . $emp_code . '/dc_pdf');
                    $check_error = false;
                } catch (Exception $error) {
                    $check_error = true;
                }

                if ($check_error) {
                    $status = 400;
                    $message = "Please Try Later Problem At PDf Upload";
                } else {
                    try {
                        DB::table('add_dc')->insert([
                            'submited_by' => $emp_code,
                            'code_number' => $code_number,
                            'mr_number' => $mr_number,
                            'person_delay' => $person_delay,
                            'designation_delay' => $designation_delay,
                            'recover_amount' => $recover_amount,
                            'date_recover_amount' => $date_recover_amount,
                            'date_deposite_bank' => $date_deposite_bank,
                            'bank_statement_url' => $temp_bank_statement_url,
                            'date_of_submit' => $submited_date,
                            'year_of_submit' => $submited_year,
                            'month_of_submit' => $submited_month,
                            'request_id' => $request_id,
                            "created_at" =>  date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s')
                        ]);
                        $check_error = false;
                    } catch (Exception $error) {
                        $check_error = true;
                    }
                }
                if ($check_error) {
                    $status = 400;
                    $message = "Please Try Later Problem At database";
                } else {
                    $status = 200;
                    $message = "Ok";
                }
            }
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
}
