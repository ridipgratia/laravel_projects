<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UnemployeAllowanceController extends Controller
{
    public function index()
    {
        return view('unemployement_allowance');
    }
    public function create(Request $request)
    {

        // Submit UNemployement Allowance Form


        if ($request->ajax()) {
            $card_number = $request->card_number;
            $work_demand = $request->work_demand;
            $total_day_unemple = $request->total_day_unemple;
            $person_delay = $request->person_delay;
            $designation_delay = $request->designation_delay;
            $recover_amount = $request->recover_amount;
            $date_recover_amount = $request->date_recover_amount;
            $date_deposite_bank = $request->date_deposite_bank;
            $bank_statement_url = $request->file('bank_statement');
            $emp_code = "emp_code_3";
            $status = null;
            $message = null;
            $error_message = [
                'required' => 'Fill Your Basic Details',
                'mimes' => 'Select Only PDF'
            ];
            $validator = Validator::make(
                $request->all(),
                [
                    'card_number' => 'required',
                    'work_demand' => 'required',
                    'total_day_unemple' => 'required',
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
                $last_id = DB::table('add_unemp_allowance')->orderBy('id', 'desc')->first();
                if ($last_id == null) {
                    $last_id = 1;
                } else {
                    $last_id = $last_id->id + 1;
                }
                $request_id = "UA" . '/' . $submited_year . '/' . $emp_code . '/' . $last_id;
                $check_error = false;
                $message = $request_id;
                $temp_bank_statement_url = null;
                try {
                    $temp_bank_statement_url = $bank_statement_url->store('public/images/' . $emp_code . '/unemploye_allowance');
                    $check_error = false;
                } catch (Exception $error) {
                    $check_error = true;
                }

                if ($check_error) {
                    $status = 400;
                    $message = "Please Try Later Problem At PDf Upload";
                } else {
                    try {
                        DB::table('add_unemp_allowance')->insert([
                            'submited_by' => $emp_code,
                            'card_number' => $card_number,
                            'work_demand' => $work_demand,
                            'total_day_unemple' => $total_day_unemple,
                            'person_delay' => $person_delay,
                            'designation_delay' => $designation_delay,
                            'recover_amount' => $recover_amount,
                            'date_recover_amount' => $date_recover_amount,
                            'date_deposite_bank' => $date_deposite_bank,
                            'bank_statement_url' => $temp_bank_statement_url,
                            'date_of_submite' => $submited_date,
                            'year_of_submite' => $submited_year,
                            'month_of_submite' => $submited_month,
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
