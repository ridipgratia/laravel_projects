<?php

namespace App\Http\Controllers\state;

use App\Http\Controllers\Controller;
use App\MyMethod\AddUserByState;
use App\MyMethod\StateMethod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddPOController extends Controller
{
    public function index()
    {
        // Fetch All Block Name And Block ID
        $blocks = DB::table('blocks')->select('block_id', 'block_name')->orderBy('block_name', 'asc')->get();
        return view('state.add_po', [
            'blocks' => $blocks
        ]);
    }
    public function add_user(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->name;
            $phone = $request->phone;
            $email = $request->email;
            $designation = $request->designation;
            $district_id = $request->district_id;
            $status = null;
            $message = null;
            $validator = AddUserByState::check_valid($request);
            if ($validator->fails()) {
                $status = 400;
                $message = "Fill All Necessary Input <br> And <br> Mobile Should Be 10 Numbers  ";
            } else {

                $registration_id = 'State_' . $district_id;
                $last_id = DB::table('make_po')->orderBy('id', 'desc')->first();
                if ($last_id == null) {
                    $last_id = 1;
                } else {
                    $last_id = $last_id->id + 1;
                }
                $record_id = $registration_id . '_' . $last_id;
                if (StateMethod::checkUserExists('make_po', $registration_id)) {
                    $status = 400;
                    $message = "Registration ID Already Exists !";
                } else {
                    $check = false;
                    try {
                        DB::table('make_po')->insert([
                            'phone' => $phone,
                            'name' => $name,
                            'email' => $email,
                            'deginations' => $designation,
                            'registration_id' => $registration_id,
                            'block_id' => $district_id,
                            'record_id' => $record_id,
                            "created_at" =>  date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s')
                        ]);
                        $check = true;
                    } catch (Exception $err) {
                        $check = false;
                    }
                    if ($check) {
                        $status = 200;
                        $message = ["User Created Successfully", $registration_id, 'password'];
                    } else {
                        $status = 400;
                        $message = "Something Error Executed !";
                    }
                }
            }
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
}
