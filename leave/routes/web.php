<?php

use App\Http\Controllers\AdminLeaveController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CurrentDateController;
use App\Http\Controllers\leave_approved;
use App\Http\Controllers\LeaveApprovedController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\leaveFromController;
use App\Http\Controllers\LeaveProfileController;
use App\Http\Controllers\LeaveRejectedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('leaveFrom', [leaveFromController::class, 'leaveFromShow']);
// Route::post('leaveFromSubmit', [leaveFromController::class, 'leaveFromPost'])->name('leave_form_post');
Route::post('leaveFromSubmit', [leaveFromController::class, 'leaveFromPost_1'])->name('leave_form_post_1');
Route::get('admin_leave', [AdminLeaveController::class, 'admin_leave_show']);
Route::get('admin_leave_submit', [AdminLeaveController::class, 'admin_leave_post']);
Route::get('admin_leave_image', [AdminLeaveController::class, 'admin_leave_image_show']);
Route::post('admin_leave_approval', [AdminLeaveController::class, 'admin_leave_approval_post']);
Route::get('leaveProfile', [LeaveProfileController::class, 'leaveProfileShow']);
Route::get('leave_approved', [LeaveApprovedController::class, 'leave_approved_show']);
Route::get('leave_rejected', [LeaveRejectedController::class, 'leave_reject_show']);
Route::get('sectin_data', [LeaveApprovedController::class, 'leave_section_get']);
Route::post('leave_controller', [LeaveController::class, 'leave_post'])->name('leave_controller_post');
Route::get('current_date_get', [CurrentDateController::class, 'current_date_get'])->name('current_date_get_route');
