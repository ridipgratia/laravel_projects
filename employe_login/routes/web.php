<?php


use App\Http\Controllers\AdminLeaveController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveFromController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashbaordController::class, 'create'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/education', [DashbaordController::class, 'education'])->middleware(['auth']);
Route::get('/dashboard/expirience', [DashbaordController::class, 'expirience'])->middleware(['auth']);
Route::get('/dashboard/leave', [DashbaordController::class, 'leave'])->middleware(['auth']);
Route::get('/dashboard/ex_file', [DashbaordController::class, 'get_ex_file'])->middleware(['auth', 'fileAuth']);
Route::get('/dashboard/edu_file', [DashbaordController::class, 'get_edu_file'])->middleware(['auth', 'fileAuth']);
Route::get('/home', [HomeController::class, 'create'])->middleware(['auth']);
Route::get('leaveFrom', [LeaveFromController::class, 'leaveFromShow'])->middleware(['auth']);
Route::post('leaveFromSubmit', [LeaveFromController::class, 'leaveFromPost_1']);
Route::post('leave', [LeaveFromController::class, 'leave_fun']);
Route::get('admin_leave_submit', [AdminLeaveController::class, 'admin_leave_post']);
Route::get('admin_leave_image', [AdminLeaveController::class, 'admin_leave_image_show']);
Route::post('admin_leave_approval', [AdminLeaveController::class, 'admin_leave_approval_post']);
require __DIR__ . '/auth.php';
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');
require __DIR__ . '/adminauth.php';
require __DIR__ . '/admin_leave.php';
require __DIR__ . './attendance.php';
Route::post('export_1', [ExportExcelController::class, 'excel'])->middleware(['exportAuth']);
