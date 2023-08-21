<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::get('/attendance', [AttendanceController::class, 'create'])->middleware(['auth']);
Route::post('/attendance/login', [AttendanceController::class, 'store_login'])->middleware(['auth']);
Route::post('/attendance/location', [AttendanceController::class, 'create_location'])->middleware(['auth']);
// Route::get('/attendance/login_submit', [AttendanceController::class, 'store_login_submit'])->middleware(['auth']);

Route::post('/attendance/locations', [AttendanceController::class, 'store_location'])->middleware(['auth']);