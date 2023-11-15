<?php

namespace App\Http\Controllers\district;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('district.notification');
    }
}
