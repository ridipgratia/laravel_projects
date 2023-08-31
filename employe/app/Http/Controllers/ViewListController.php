<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewListController extends Controller
{
    public function show_view_list()
    {
        return view('view_list');
    }
    public function post_view_list(Request $request)
    {
        $child_names = $request->child_name;
        $child_dobs = $request->child_dob;
        $child_genders = $request->child_gender;
        $child_images = $request->file('child_file');
        $child_disabled_file = $request->file('child_disabled_file');
        $disabled_file_text = $request->count_disabled_file;
        $disabled_file_arr = explode(',', $disabled_file_text);
        $count_disabled_file = count($disabled_file_arr);
        $child_count = count($child_names);
        $check = true;
        $values = [];
        if ($request->hasFile('child_file')) {
            foreach ($request->file('child_file') as $file) {
                $extension = ['jpeg', 'jpg', 'png'];
                if (in_array($file->getClientOriginalExtension(), $extension)) {
                    array_push($values, $file);
                }
            }
        }
        $disabled_files = [];
        if ($request->hasFile('child_disabled_file')) {
            foreach ($request->file('child_disabled_file') as $disabled_file) {
                $extension = ['jpeg', 'jpg', 'png'];
                if (in_array($disabled_file->getClientOriginalExtension(), $extension)) {
                    array_push($disabled_files, $disabled_file);
                }
            }
        }
        $disabled_upload_files_true = array();
        $disabled_upload_files_false = array();
        for ($i = 0; $i < $count_disabled_file; $i++) {
            if ($disabled_file_arr[$i] == 1) {
                array_push($disabled_upload_files_true, $i);
            } else {
                array_push($disabled_upload_files_false, $i);
            }
        }
        if (count($disabled_files) == count($disabled_upload_files_true)) {
            if (count($values) == $child_count) {
                for ($i = 0; $i < count($child_names); $i++) {
                    if ($child_names[$i] == "" || $child_dobs[$i] == "") {
                        $check = false;
                        $data = "not Ok";
                        break;
                    } else {
                        $check = true;
                        $data = "Ok";
                    }
                }
            } else {
                $check = false;
                $data = "not Ok";
            }
        } else {
            $check = false;
            $data = "not Ok";
        }
        if ($check) {
            $emp_data = DB::table('employe_child')->where('e_id', 15)->get();
            if (count($emp_data) != 0) {
                return response()->json(['status' => 400, 'message' => 'Child Details Already Submited ']);
            } else {
                DB::table('employe_child')->insert([
                    'e_id' => 15,
                    'child_status' => 1,
                    'no_child' => count($child_names),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $employe_data = DB::table('employe_child')->where('e_id', 15)->get();
                $file_incree = 0;
                for ($i = 0; $i < count($child_names); $i++) {
                    $temp = $child_images[$i]->store('public/images/' . strval($employe_data[0]->id));
                    $temp_1 = null;
                    $disabled = null;
                    if ($disabled_file_arr[$i] == 1) {
                        $temp_1 = $child_disabled_file[$file_incree]->store('public/images/' . strval($employe_data[0]->id));
                        $disabled = 1;
                        $file_incree = $file_incree + 1;
                    } else {
                        $disabled = 0;
                    }
                    DB::table('child_details')->insert([
                        'child_id' => $employe_data[0]->id,
                        'child_name' => $child_names[$i],
                        'child_dob' => $child_dobs[$i],
                        'child_gender' => $child_genders[$i],
                        'dob_doc' => $temp,
                        'child_disabled_file' => $temp_1,
                        'disabled_status' => $disabled,
                        'c_created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                return response()->json(['status' => 200, 'message' => 'Information Updated']);
            }
        } else {
            return response()->json(['status' => 400, 'message' => 'Fill All Necessary Inputs ']);
        }
    }
    public function add_zero_child_post(Request $request)
    {
        DB::table('employe_child')->insert([
            'e_id' => 14,
            'child_status' => 0,
            'no_child' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return response()->json(['status' => 200, 'message' => 'Successfully Submited !']);
    }
    public  function child_check_disbaled(Request $request)
    {
        $status = null;
        $check = $_GET['check'];
        if ($request->ajax()) {
            $content = null;
            if ($check == 'true') {
                $content = "<p>*Disabled Vertificate</p><input type='file' name='child_disabled_file[]' class='child_input  child_file'>";
                return $content;
            } else {
                return $content;
            }
        } else {
            return redirect('/view_list');
        }
    }
    public function review_child_post(Request $request)
    {
        return response()->json(['status' => 200]);
    }
}
