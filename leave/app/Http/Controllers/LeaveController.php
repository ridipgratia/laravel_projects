<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function leave_post(Request $request)
    {
        return response()->json(['status' => 200, 'message' => 'Ok']);
    }
}
