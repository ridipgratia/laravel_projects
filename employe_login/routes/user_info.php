<?php

use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/user_info', [UserInfoController::class, 'user_info_index']);
