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
    // Search Query Algo
    public static function searchByDisBloGpDates($form_date, $to_date, $district_code, $block_name, $gp_name, $table)
    {
        $status = null;
        $message = null;
        if ($form_date === null && $to_date === null && $district_code === null && $block_name === null && $gp_name === null) {
            $status = 200;
            $message = "All Data";
            $result = DB::table($table)
                ->get();
            $message = array($result);
        } else {
            if (($form_date === null && $to_date !== null) || ($form_date !== null && $to_date === null)) {
                $status = 400;
                $message = "Select Both Dates !";
            } else {
                if ($form_date !== null && $district_code !== null && $block_name !== null && $gp_name !== null) {
                    if ($form_date <= $to_date) {
                        $status = 200;
                        $form_to_date = DistrictMethod::getPeriodDates($form_date, $to_date);
                        $form_date_his = array();
                        foreach ($form_to_date as $dates) {
                            if (StateMethod::checkIsDateAvai($table, $dates)) {
                                $form_data = DB::table($table)
                                    ->where('date_of_submit', $dates)
                                    ->where('district_id', $district_code)
                                    ->where('block_id', $block_name)
                                    ->where('gp_id', $gp_name)
                                    ->get();
                                array_push($form_date_his, $form_data);
                            }
                        }
                        $message = $form_date_his;
                    } else {
                        $status = 400;
                        $message = "Select A Valid Dates";
                    }
                } else {
                    if ($form_date !== null && $district_code !== null && $block_name !== null) {
                        if ($form_date <= $to_date) {
                            $status = 200;
                            $form_to_date = DistrictMethod::getPeriodDates($form_date, $to_date);
                            $form_date_his = array();
                            foreach ($form_to_date as $dates) {
                                if (StateMethod::checkIsDateAvai($table, $dates)) {
                                    $form_data = DB::table($table)
                                        ->where('date_of_submit', $dates)
                                        ->where('district_id', $district_code)
                                        ->where('block_id', $block_name)
                                        ->get();
                                    array_push($form_date_his, $form_data);
                                }
                            }
                            $message = $form_date_his;
                        } else {
                            $status = 400;
                            $message = "select A Valid Dates";
                        }
                    } else {
                        if ($form_date !== null && $district_code !== null) {
                            if ($form_date <= $to_date) {
                                $status = 200;
                                $form_to_date = DistrictMethod::getPeriodDates($form_date, $to_date);
                                $form_date_his = array();
                                foreach ($form_to_date as $dates) {
                                    if (StateMethod::checkIsDateAvai($table, $dates)) {
                                        $form_data = DB::table($table)
                                            ->where('date_of_submit', $dates)
                                            ->where('district_id', $district_code)
                                            ->get();
                                        array_push($form_date_his, $form_data);
                                    }
                                }
                                $message = $form_date_his;
                            } else {
                                $status = 400;
                                $message = "Select A Valid Dates";
                            }
                        } else {
                            if ($district_code !== null) {
                                if ($block_name !== null) {
                                    if ($gp_name !== null) {
                                        $status = 200;
                                        $result = DB::table($table)
                                            ->where('district_id', $district_code)
                                            ->where('block_id', $block_name)
                                            ->where('gp_id', $gp_name)
                                            ->get();
                                        $message = array($result);
                                    } else {
                                        $status = 200;
                                        $result = DB::table($table)
                                            ->where('district_id', $district_code)
                                            ->where('block_id', $block_name)
                                            ->get();
                                        $message = array($result);
                                    }
                                } else {
                                    $status = 200;
                                    $result = DB::table($table)
                                        ->where('district_id', $district_code)
                                        ->get();
                                    $message = array($result);
                                }
                            } else {
                                if ($form_date !== null) {
                                    if ($form_date <= $to_date) {
                                        $status = 200;
                                        $form_to_date = DistrictMethod::getPeriodDates($form_date, $to_date);
                                        $form_date_his = array();
                                        foreach ($form_to_date as $dates) {
                                            if (StateMethod::checkIsDateAvai($table, $dates)) {
                                                $form_data = DB::table($table)
                                                    ->where('date_of_submit', $dates)
                                                    ->get();
                                                array_push($form_date_his, $form_data);
                                            }
                                        }
                                        $message = $form_date_his;
                                    } else {
                                        $status = 400;
                                        $message = "Select A Valid Dates";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return [$status, $message];
    }
    public static function checkIsDateAvai($table, $date)
    {
        $check = DB::table($table)
            ->where('date_of_submit', $date)
            ->get();
        if (count($check) == 0) {
            return false;
        } else {
            return true;
        }
    }
}
