<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

use function PHPSTORM_META\type;

class RegistrationController extends Controller
{
    public function registration_show()
    {
        $designations = DB::table('designations')->get();
        $blood_groups = DB::table('blood_group')->get();
        $genders = DB::table('employe_gender')->get();
        return view('registration', ['designations' => $designations, 'blood_groups' => $blood_groups, 'genders' => $genders]);
    }
    public function registration_post(Request $request)
    {
        $index_num = $request->index_num;
        $index_num = intval($index_num);
        $status = null;
        $message = null;
        $edu_check = true;
        $ex_check = true;
        $edu_values = array();
        $ex_value = array();
        $ex_year = array();
        $year = null;
        $all_error = array();
        $emp_board_name = $request->emp_board_name;
        $emp_degree = $request->emp_degree;
        $emp_schol = $request->emp_school;
        $emp_passing_year = $request->emp_passing_year;
        $emp_percentage = $request->emp_percentage;
        $emp_marks = $request->emp_marks;
        $emp_education_file = $request->file('emp_education_file');
        $emp_com_name = $request->emp_com_name;
        $emp_form_date = $request->emp_form_date;
        $emp_to_date = $request->emp_to_date;
        $emp_role = $request->emp_role;
        $emp_ex_file = $request->file('emp_ex_certificate');
        $join_year = date('Y', strtotime($request->emp_join_date));
        $join_month = date('m', strtotime($request->emp_join_date));
        $current_year = date('Y');
        $current_month = date('m');
        $allocation = null;
        $balance = null;
        if ($join_year != $current_year) {
            $allocation = 12;
            $balance = $current_month;
        } else {
            $allocation = (12 - $join_month) + 1;
            $balance = ($current_month - $join_month) + 1;
        }
        $messages = [
            'required' => 'Fill Your Basic Details',
            'emp_code.unique' => 'Empoye Code Already Exists',
            'emp_phone.unique' => 'Phone No Already Exists ',
            'emp_email.unique' => 'Email ID Already Exists',
            'emp_account_no.unique' => 'Account Number Alrady Exists ',
            'emp_phone.digits' => 'Phone No Must Valid 10 Digit',
            'emp_email.email' => 'The Email ID Must Be Valid',
        ];
        $basic_details = Validator::make(
            $request->all(),
            [
                'emp_code' => 'required|unique:all_employe_details,emp_code',
                'emp_name' => 'required',
                'emp_father' => 'required',
                'emp_mother' => 'required',
                'emp_designation' => 'required|not_in:0',
                'date_of_birth' => 'required',
                'emp_join_date' => 'required',
                'emp_phone' => 'required|numeric|digits:10|unique:all_employe_details,phone',
                'emp_email' => 'required|email|unique:all_employe_details,email',
                'blood_group' => 'required|not_in:0',
                'emp_bank_name' => 'required',
                'emp_account_no' => 'required|unique:all_employe_details,account_no',
                'emp_ifsc_code' => 'required',
                'emp_brance_name' => 'required'
            ],
            $messages,
        );
        $all_errors = array();
        // start education validation
        if ($request->hasFile('emp_education_file')) {
            foreach ($request->file('emp_education_file') as $file) {
                $extension = ['jpeg', 'jpg', 'png'];
                if (in_array($file->getClientOriginalExtension(), $extension)) {
                    array_push($edu_values, $file);
                }
            }
        }
        if (count($edu_values) == count($emp_board_name)) {
            for ($i = 0; $i < count($emp_board_name); $i++) {
                if ($emp_board_name[$i] == null || $emp_degree[$i] == null || $emp_schol[$i] == null || $emp_passing_year[$i] == null || $emp_percentage[$i] == null || $emp_marks[$i] == null) {
                    $edu_check = false;
                    if ($index_num == 2) {
                        array_push($all_error, 'Fill All Educational Details !');
                    }
                    break;
                } else {
                    $edu_check = true;
                }
            }
        } else {
            $edu_check = false;
            if ($index_num == 2) {
                array_push($all_error, 'Select A Valid Education Certificate As Image');
            }
        }
        // start employe Expirience

        if ($request->hasFile('emp_ex_certificate')) {
            foreach ($request->file('emp_ex_certificate') as $file_1) {
                $extension = ['jpeg', 'jpg', 'png'];
                if (in_array($file_1->getClientOriginalExtension(), $extension)) {
                    array_push($ex_value, $file_1);
                }
            }
        }
        if (count($ex_value) == count($emp_com_name)) {
            for ($i = 0; $i < count($emp_com_name); $i++) {
                if ($emp_com_name[$i] == null || $emp_form_date[$i] == null || $emp_to_date[$i] == null || $emp_role[$i] == null) {
                    $ex_check = false;
                    if ($index_num == 3) {
                        array_push($all_error, 'Fill All Expirience Details');
                    }
                    break;
                } else {
                    $ex_check = true;
                    $date_1 = new DateTime($emp_form_date[$i]);
                    $date_2 = new DateTime($emp_to_date[$i]);
                    $interval = $date_1->diff($date_2);
                    $year = $interval->y . '-' . $interval->m . '-' . $interval->d;
                    array_push($ex_year, $year);
                }
            }
        } else {
            $ex_check = false;
            if ($index_num == 3) {
                array_push($all_error, 'Select A Valid Expirience Certificate As Image');
            }
        }

        // start amin validation
        $mess = null;
        if ($index_num == 1) {
            if ($basic_details->fails()) {
                $err =  $basic_details->errors();
                foreach ($err->all() as $errors) {
                    array_push($all_error, $errors);
                }
                $all_error = array_unique($all_error);
                $status = 400;
            } else {
                $status = 200;
            }
        }
        if ($index_num == 2) {
            if ($edu_check) {
                $status = 200;
            } else {
                $status = 400;
            }
        }
        if ($index_num == 3) {
            if ($ex_check == false) {
                $status = 400;
            } else {
                if ($basic_details->fails()) {
                    $status = 400;
                } else {
                    if ($edu_check == false) {
                        $status = 400;
                    } else {
                        DB::table('all_employe_details')->insert([
                            'emp_code' => $request->emp_code,
                            'employe_name' => $request->emp_name,
                            'employe_father_name' => $request->emp_father,
                            'employe_mother_name' => $request->emp_mother,
                            'gender_id' => $request->emp_gender,
                            'designation_id' => $request->emp_designation,
                            'DOB' => $request->date_of_birth,
                            'join_date' => $request->emp_join_date,
                            'phone' => $request->emp_phone,
                            'email' => $request->emp_email,
                            'blood_group' => $request->blood_group,
                            'bank_name' => $request->emp_bank_name,
                            'account_no' => $request->emp_account_no,
                            'IFSC_code' => $request->emp_ifsc_code,
                            'branch_name' => $request->emp_brance_name,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                        $emp_id = DB::table('all_employe_details')->where('emp_code', $request->emp_code)->select('id')->get();
                        for ($i = 0; $i < count($emp_board_name); $i++) {
                            $edu_certificate = $emp_education_file[$i]->store('public/images/' . strval($emp_id[0]->id));
                            DB::table('employe_education_details')->insert(['e_id' => $emp_id[0]->id, 'board' => $emp_board_name[$i], 'school_college' => $emp_schol[$i], 'degree' => $emp_degree[$i], 'year' => $emp_passing_year[$i], 'percentage' => $emp_percentage[$i], 'marks' => $emp_marks[$i], 'education_certificate' => $edu_certificate, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
                        }
                        for ($i = 0; $i < count($emp_com_name); $i++) {
                            $ex_certificate = $emp_ex_file[$i]->store('public/images/' . strval($emp_id[0]->id));
                            DB::table('employe_expirience')->insert(['e_id' => $emp_id[0]->id, 'company_name' => $emp_com_name[$i], 'ex_year' => $ex_year[$i], 'emp_role' => $emp_role[$i], 'to_date' => $emp_to_date[$i], 'form_date' => $emp_form_date[$i], 'ex_certificate' => $ex_certificate, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
                        }
                        DB::table('leave_allocation')->insert(['e_id' => $emp_id[0]->id, 'leave_id' => 1, 'year' => $current_year, 'leave_allocation' => $allocation, 'leave_balance' => $balance]);
                        DB::table('leave_allocation')->insert(['e_id' => $emp_id[0]->id, 'leave_id' => 2, 'year' => $current_year, 'leave_allocation' => 7, 'leave_balance' => 7]);
                        $message = "Registration Completed Sucessfully";
                        $status = 200;
                    }
                }
            }
        }
        return response()->json(['status' => $status, 'all_error' => $all_error, 'message' => $message]);
    }
}
// "SQLSTATE[22003]: Numeric value out of range: 1264 Out of range value for column 'phone' at row 1 (SQL: insert into `all_employe_details` (`emp_code`, `employe_name`, `employe_father_name`, `employe_mother_name`, `gender_id`, `designation_id`, `DOB`, `join_date`, `phone`, `email`, `blood_group`, `bank_name`, `account_no`, `IFSC_code`, `branch_name`) values (code123, ridip goswami, father name, mother name, 1, 1, 1999-07-01, 2023-07-10, 7002142698, memorytemp5@gmail.com, 1, HDFC Bank, 3443833, HDFC43897438, ?))"
