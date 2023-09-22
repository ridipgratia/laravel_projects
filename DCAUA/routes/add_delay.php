<?php

use App\Http\Controllers\AddDelayController;
use App\Http\Controllers\DelayConpensationFormListController;
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

Route::get('/add_delay', [AddDelayController::class, 'index']);
Route::post('/add_delay_submit', [AddDelayController::class, 'create']);
Route::get('/delay_compensation_form_list', [DelayConpensationFormListController::class, 'create']);
Route::get('/delay_compensation_form_list/form_list', [DelayConpensationFormListController::class, 'form_list']);
