<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeLoginController extends Controller
{
    public function create()
    {

        return view('employe_login');
    }
}
