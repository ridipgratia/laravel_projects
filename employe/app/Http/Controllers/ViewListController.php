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
        $child_education = $request->education;
        $child_genders = $request->child_gender;
        $child_images = $request->file('child_file');
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
        if (count($values) == $child_count) {
            for ($i = 0; $i < count($child_names); $i++) {
                if ($child_names[$i] == "" || $child_dobs[$i] == "" || $child_education[$i] == "") {
                    $check = false;
                    break;
                } else {
                    $check = true;
                }
            }
        } else {
            $check = false;
        }
        if ($check) {
            $emp_data = DB::table('employe_child')->where('e_id', 15)->get();
            if (count($emp_data)) {
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
                for ($i = 0; $i < count($child_names); $i++) {
                    $temp = $child_images[$i]->store('public/images/' . strval($employe_data[0]->id));
                    DB::table('child_details')->insert([
                        'child_id' => $employe_data[0]->id,
                        'child_name' => $child_names[$i],
                        'child_dob' => $child_dobs[$i],
                        'child_gender' => $child_genders[$i],
                        'dob_doc' => $temp,
                        'education_status' => $child_education[$i],
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
    public function review_child_post(Request $request)
    {
        return response()->json(['status' => 200]);
    }
}
