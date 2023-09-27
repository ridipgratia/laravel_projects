<?php

namespace App\MyMethod;

use Illuminate\Support\Facades\DB;

class StateMethod
{
    public static function checkUserExists($table, $registration_id)
    {
        $registration_id = DB::table($table)->where('registration_id', $registration_id)->get();
        if (count($registration_id) == 0) {
            return false;
        } else {
            return true;
        }
    }
}
