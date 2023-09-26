<?php

namespace App\MyMethod;

use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class DelayEmpForm
{
    // To Check Is Date Exists Or Not 
    public static function checkIsDateAvai($date, $table)
    {
        $check_date = DB::table($table)->where('submited_by', 'emp_code_3')->where('date_of_submit', $date)->get();
        if (count($check_date) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // To Get Data Date Wise 
    public static function getFromdata($date, $table)
    {
        $form_data = DB::table($table)->where('submited_by', 'emp_code_3')->where('date_of_submit', $date)->get();
        return $form_data;
    }
    // get Approval data
    public static function getApproaveData($table)
    {
        $form_list = DB::table($table)->where('submited_by', 'emp_code_3')->where('approval_status', 1)->select('id', 'request_id', 'date_of_submit')->get();
        return $form_list;
    }
    // Check Is FTO No Exists 
    public static function checkIsFTO($table, $form_id)
    {
        $FTO_lists = DB::table($table)->where('submited_by', 'emp_code_3')->where('form_id', $form_id)->select('id')->get();
        if (count($FTO_lists) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // Check Form ID Avaible Or Not 
    public static function checkFormIDAvai($table, $form_id)
    {
        $check_form_id = DB::table($table)->where('submited_by', 'emp_code_3')->where('id', $form_id)->select('id')->get();
        if (count($check_form_id) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // Check Approval Status Of Form ID
    public static function checkApprovalStatus($table, $form_id)
    {
        $check_approval = DB::table($table)->where('submited_by', 'emp_code_3')->where('id', $form_id)->where('approval_status', 1)->select('id')->get();
        if (count($check_approval) == 0) {
            return false;
        } else {
            return true;
        }
    }
    // Get FTO Number 
    public static function getFTOData($table, $form_id)
    {
        $get_FTO_data = DB::table($table)->where('submited_by', 'emp_code_3')->where('form_id', $form_id)->get();
        return $get_FTO_data;
    }
}
