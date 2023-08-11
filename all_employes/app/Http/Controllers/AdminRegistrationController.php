<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use WeakReference;

class AdminRegistrationController extends Controller
{
    public function admin_registration_show()
    {

        $designations = DB::table('designations')->get();
        $count_desg = array();
        foreach ($designations as $desgination) {
            $count = DB::table('all_employe_details')->where('designation_id', $desgination->id)->count();
            array_push($count_desg, $count);
        }
        return view('admin_registration', ['designations' => $designations, 'count_designations' => $count_desg]);
    }
    public function get_employe_data()
    {
        $action = $_GET['action'];
        if ($action) {

            $employe_data = DB::table('all_employe_details as emp_data')->select('emp_data.id as id', 'emp_data.emp_code as emp_code', 'emp_data.employe_name as employe_name', 'desig.designation_name as designation_name', 'emp_data.phone as phone', 'emp_data.email as email')
                ->join('designations as desig', 'desig.id', '=', 'emp_data.designation_id')->get();
            return response()->json(['employe_data' => $employe_data]);
        } else {
            return redirect('admin_registration');
        }
    }
    public function get_all_employe_data()
    {
        $employe_id = $_GET['employe_id'];

        if ($employe_id != null) {
            $employe_data = DB::table('all_employe_details as emp_data')->where('emp_data.id', $employe_id)
                ->join('designations as desig', 'emp_data.designation_id', '=', 'desig.id')
                ->join('employe_gender as emp_gender', 'emp_data.gender_id', '=', 'emp_gender.id')
                ->select(
                    'emp_data.id as id',
                    'emp_data.emp_code as emp_code',
                    'emp_data.employe_name as employe_name',
                    'emp_data.employe_father_name as employe_father_name',
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
            $employe_education = DB::table('employe_education_details')->where('e_id', $employe_data[0]->id)->get();
            $employe_expirience = DB::table('employe_expirience')->where('e_id', $employe_data[0]->id)->get();
            return response()->json(['status' => 200, 'employe_data' => $employe_data, 'employe_education' => $employe_education, 'exploye_expirience' => $employe_expirience]);
        }
    }
    public function get_education_details()
    {
        $employe_id = $_GET['employe_id'];
        $education_id = $_GET['education_id'];
        $education_details = DB::table('employe_education_details')->where('e_id', $employe_id)->where('id', $education_id)->get();
        return response()->json(['status' => 200, 'education_details' => $education_details]);
    }
    public function get_file_location()
    {
        $image = $_GET['url'];
        $status = null;
        $image_url = null;
        if ($image == null) {
            $status = null;
        } else {
            $image_url = Storage::url($image);
            $status = 200;
        }
        return response()->json(['status' => $status, 'image_url' => $image_url]);
    }
}
