<?php

namespace App\MyMethod;

use App\MyMethod\StateMethod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AddUserByState
{
    public static function check_valid($request)
    {
        $error_message = [
            'required' => 'Fill Your Basic Details',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'phone' => 'required|min:10|max:10',
                'email' => 'required',
                'designation' => 'required',
                'district_id' => 'required',
            ],
            $error_message,
        );
        return $validator;
    }
    public static function user_list($table)
    {
        $users_list = DB::table($table)->select('id', 'name', 'deginations', 'registration_id')->get();
        return $users_list;
    }
    public static function user_html_data($user_data)
    {
        $active = null;
        if ($user_data[0]->delete == 0) {
            $active = "btn btn-danger";
        } else {
            $active = "btn btn-primary";
        }
        $content = '<p class="col-md-4 col-sm-12 border border-primary">Employe Name</p>
            <p class="col-md-7 col-sm-12 border border-primary">' . $user_data[0]->name . '</p>
            <p class="col-md-4 col-sm-12 border border-primary">Phone No</p>
            <p class="col-md-7 col-sm-12 border border-primary">' . $user_data[0]->phone . '</p>
            <p class="col-md-4 col-sm-12 border border-primary">Email ID</p>
            <p class="col-md-7 col-sm-12 border border-primary">' . $user_data[0]->email . '</p>
            <p class="col-md-4 col-sm-12 border border-primary">Designation</p>
            <p class="col-md-7 col-sm-12 border border-primary">' . $user_data[0]->deginations . '</p>
            <p class="col-md-4 col-sm-12 border border-primary">Registration ID</p>
            <p class="col-md-7 col-sm-12 border border-primary">' . $user_data[0]->registration_id . '</p>
            <p class="col-md-4 col-sm-12 border border-primary">District</p>
            <p class="col-md-7 col-sm-12 border border-primary">' . $user_data[0]->join_col_name . '</p>
            <div class="col-12">
                <button type="button" class=" ' . $active . '">Active Employe</button>
            </div>';
        return $content;
    }
    public static function resetUserPass($request, $table)
    {
        $id = $_GET['id'];
        $password = $_GET['password'];
        $status = null;
        $message = null;
        if (isset($id)) {
            if (empty($password)) {
                $message = "Enter New Password";
                $status = 400;
            } else {
                try {
                    DB::table($table)->where('id', $id)->update(['password' => $password]);
                    $message = "Password Changed";
                    $status = 200;
                } catch (Exception $err) {
                    $status = 400;
                    $message = "Server Error !Please Try Again !";
                }
            }
        } else {
            $message = "Try With  !";
            $status = 400;
        }
        return [$status, $message];
    }
    public static function RemoveUser($request, $table)
    {
        $id = $_GET['id'];
        $status = null;
        $message = null;
        if (isset($id)) {
            try {
                DB::table($table)->where('id', $id)->delete();
                $message = "User Removed ";
                $status = 200;
            } catch (Exception $err) {
                $status = 400;
                $message = "Server Error ! Please Try Again";
            }
        } else {
            $status = 400;
            $message = null;
        }
        return [$status, $message];
    }
}