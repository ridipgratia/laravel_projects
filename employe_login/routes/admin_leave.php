
<?php

use App\Http\Controllers\Adminauth\AuthenticatedSessionController;
use App\Http\Controllers\AdminLeaveController;
use App\Http\Controllers\LeaveApprovedController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/admin_leave', [AdminLeaveController::class, 'admin_leave_show'])
        ->name('admin_leave');
    Route::get('/sectin_data', [LeaveApprovedController::class, 'leave_section_get']);
    Route::get('admin_leave_submit', [AdminLeaveController::class, 'admin_leave_post']);
    Route::get('admin_leave_image', [AdminLeaveController::class, 'admin_leave_image_show']);
    Route::post('admin_leave_approval', [AdminLeaveController::class, 'admin_leave_approval_post']);
});
