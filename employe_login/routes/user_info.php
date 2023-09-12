<?php

use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/user_info', [UserInfoController::class, 'user_info_index'])->middleware(['auth']);
Route::post('/user_info/change_password', [UserInfoController::class, 'user_info_change_pass'])->middleware(['auth']);
Route::get('/user_info/change_password_confirmation/{secret_key}', [UserInfoController::class, 'user_info_change_pass_confirmation'])->middleware(['auth']);
Route::post('/user_info/change_user_basic', [UserInfoController::class, 'change_user_basic_update'])->middleware(['auth']);
Route::post('/user_info/update_employe_profile', [UserInfoController::class, 'update_employe_profile_method'])->middleware(['auth']);
Route::get('/user_info/show_employe_profile/{profile_url}', [UserInfoController::class, 'show_employe_profile_method'])->middleware(['auth']);
