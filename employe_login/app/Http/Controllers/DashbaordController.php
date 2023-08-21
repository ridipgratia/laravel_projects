<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class DashbaordController extends Controller
{
    public function create()
    {
        $employe_data = DB::table('all_employe_details as emp_data')->where('emp_data.id', Auth::user()->e_id)
            ->join('designations as desig', 'emp_data.designation_id', '=', 'desig.id')
            ->join('employe_gender as emp_gender', 'emp_data.gender_id', '=', 'emp_gender.id')
            ->select(
                'emp_data.id as id',
                'emp_data.emp_code as emp_code',
                'emp_data.employe_name as employe_name',
                'emp_data.employe_father_name as employe_father_name',
                'emp_data.employe_mother_name as employe_mother_name',
                'emp_data.DOB as DOB',
                'emp_data.join_date as join_date',
                'emp_data.phone as phone',
                'emp_data.email as email',
                'emp_data.blood_group',
                'emp_data.bank_name as bank_name',
                'emp_data.account_no as account_no',
                'emp_data.IFSC_code as IFSC_code',
                'emp_data.branch_name as branch_name',
                'emp_gender.gender as gender',
                'desig.designation_name as designation_name',
            )
            ->get();
        return view('dashboard', ['employe_data' => $employe_data]);
    }
    public function click()
    {
        sleep(2);
        return response()->json(['message' => 'Ok']);
    }

    public function getDetails($table_name, $emp_code)
    {
        $auth_emp_code = Auth::user()->e_id;
        if ($auth_emp_code == $emp_code) {
            $education_data = DB::table($table_name)->where('e_id', $emp_code)->get();
            return ['status' => 200, 'message' => $education_data];
        } else {
            return ['status' => 400, 'message' => null];
        }
    }
    public function education()
    {
        if (isset($_GET['emp_code'])) {
            $emp_code = $_GET['emp_code'];
            $info = $this->getDetails('employe_education_details', $emp_code);
            return response()->json(['status' => $info['status'], 'message' => $info['message']]);
        } else {
            return redirect('/dashboard');
        }
    }
    public function expirience()
    {
        if (isset($_GET['emp_code'])) {
            $emp_code = $_GET['emp_code'];
            $info = $this->getDetails('employe_expirience', $emp_code);
            return response()->json(['status' => $info['status'], 'message' => $info['message']]);
        } else {
            return redirect('/dashboard');
        }
    }
    public function leave()
    {
        if (isset($_GET['emp_code'])) {
            $emp_code = $_GET['emp_code'];
            $info = DB::table('leave_allocation as leave_allo')->where('leave_allo.e_id', $emp_code)
                ->join('type_of_leave as t_leave', 'leave_allo.leave_id', '=', 't_leave.id')
                ->select('*')->get();
            return response()->json(['status' => 200, 'message' => $info]);
        } else {
            return redirect('/dashboard');
        }
    }
    public function get_ex_file()
    {
        $imageUrl = Storage::url($_GET['imageUrl']);
        if ($imageUrl != null) {
            return response()->json(['status' => 200, 'imageURL' => $imageUrl]);
        } else {
            return response()->json(['status' => 400]);
        }
    }
    public function get_edu_file()
    {
        $imageUrl = Storage::url($_GET['imageUrl']);
        if ($imageUrl != null) {
            return response()->json(['status' => 200, 'imageURL' => $imageUrl]);
        } else {
            return response()->json(['status' => 400]);
        }
    }
}
