<?php

use App\Http\Controllers\DashbaordController;
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
Route::get('/home', [HomeController::class, 'create'])->middleware(['auth']);
Route::get('leaveFrom', [LeaveFromController::class, 'leaveFromShow'])->middleware(['auth']);
Route::post('leaveFromSubmit', [LeaveFromController::class, 'leaveFromPost_1']);
Route::post('leave', [LeaveFromController::class, 'leave_fun']);
require __DIR__ . '/auth.php';
