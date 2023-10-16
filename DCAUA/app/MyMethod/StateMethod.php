<?php

namespace App\MyMethod;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StateMethod
{
    public static function checkUserExists($table, $registration_id)
    {
        $registration_id = DB::table($table)->where('registration_id', $registration_id)->where('delete', 1)->get();
        if (count($registration_id) == 0) {
            return false;
        } else {
            return true;
        }
    }
    public static function check_valid($request)
    {
        $error_message = [
            'required' => 'Fill Your Basic Details',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'user_name' => 'required',
                'user_phone' => 'required|min:10|max:10',
                'user_email' => 'required',
                'user_degisnation' => 'required',
                // 'select_stage' => 'required',
            ],
            $error_message,
        );
        return $validator;
    }
    public static function checkStage($table, $stage, $value)
    {

        $data = DB::table($table)->where($stage, $value)->select('id')->get();
        if (count($data) == 0) {
            return false;
        } else {
            return true;
        }
    }
    public static function getUserData($table, $id)
    {
        $data = DB::table($table)->where('id', $id)->get();
        return $data;
    }
    public static function updateUserData($table, $id, $update_data)
    {
        // $registration_id = "State_" . $update_data[4];
        $registration_id = DB::table($table)->where('id', $id)->select('registration_id')->get();
        DB::table($table)->where('id', $id)->update([
            'phone' => $update_data[0],
            'name' => $update_data[1],
            'email' => $update_data[2],
            'deginations' => $update_data[3],
            // 'distrcit_id' => $update_data[4],
            // 'registration_id' => $registration_id
        ]);
        DB::table('login_details')->where('login_id', $registration_id[0]->registration_id)
            ->update([
                'login_email' => $update_data[2]
            ]);
    }
    // Get All District
    public static function getDistricts()
    {
        $districts = DB::table('districts')->select('district_code', 'district_name')->get();
        return $districts;
    }
    // Get Blocks By Distrcit Code
    public static function getBlocks($district_code)
    {
        $blocks = DB::table('blocks')
            ->where('district_id', $district_code)
            ->select('block_id', 'block_name')
            ->orderBy('block_name', 'asc')
            ->get();
        return $blocks;
    }
    // Get GPs By Block Id
    public static function getGP($block_id)
    {
        $gp = DB::table('gram_panchyats')
            ->where('block_id', $block_id)
            ->select('gram_panchyat_id', 'gram_panchyat_name')
            ->get();
        return $gp;
    }
    public static function getFormLists($table)
    {
        $form_lists = DB::table($table)->get();
        return $form_lists;
    }
}
