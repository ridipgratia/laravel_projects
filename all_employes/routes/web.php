<?php

use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\RegistrationController;
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
Route::get('registration', [RegistrationController::class, 'registration_show']);
Route::post('registration', [RegistrationController::class, 'registration_post']);
Route::get('admin_registration', [AdminRegistrationController::class, 'admin_registration_show']);
Route::get('admin_registration/employe_data', [AdminRegistrationController::class, 'get_employe_data']);
Route::get('admin_registration/all_employe_data', [AdminRegistrationController::class, 'get_all_employe_data']);
Route::get('admin_registration/education_details', [AdminRegistrationController::class, 'get_education_details']);
Route::get('admin_registration/file_location', [AdminRegistrationController::class, 'get_file_location']);
