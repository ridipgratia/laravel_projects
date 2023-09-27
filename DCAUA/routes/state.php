<?php

use App\Http\Controllers\state\AddCEOController;
use App\Http\Controllers\StateController;
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

// CheckAuth Middleware  For check is user logged in

// State Dash Board Page 
Route::get('/state_dash', [StateController::class, 'index'])->middleware(['CheckAuth']);

// Add CEO Pd User By State Load Form
Route::get('/add_ceo', [AddCEOController::class, 'index'])->middleware(['CheckAuth']);
// Add CEO PD User By State Form Submit
Route::post('/add_ceo', [AddCEOController::class, 'add_user']);
