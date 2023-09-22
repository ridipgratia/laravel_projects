<?php

use App\Http\Controllers\UnemployeAllowanceController;
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

Route::get('/unemploye_allowance', [UnemployeAllowanceController::class, 'index']);
Route::post('/add_unemploye_allowance', [UnemployeAllowanceController::class, 'create']);
