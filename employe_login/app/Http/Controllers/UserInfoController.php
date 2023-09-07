<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserInfoController extends Controller
{
    public function user_info_index()
    {
        $user_info = DB::table('all_employe_details as all_emp_de')
            ->where('all_emp_de.id', Auth::user()->e_id)
            ->select(
                'all_emp_de.emp_code',
                'all_emp_de.employe_name',
                'all_emp_de.phone',
                'all_emp_de.email',
                'deg.designation_name'
            )
            ->join('designations as deg', 'deg.id', '=', 'all_emp_de.designation_id')
            ->get();
        return view('user_info', ['user_info' => $user_info]);
    }
}
