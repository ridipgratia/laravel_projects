<?php

use App\Http\Controllers\AddFTOController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Middleware\CheckLogRoute;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Login Route Here 

// Middleware Info ->
//     1 . CheckAuth -> For check is user logged in or not 
//     2. CheckLogRoute -> redirect dashboard page according role wise if logged in

// Main Routes Here

Route::get('/', [LoginController::class, 'index'])->middleware(['CheckLogRoute']);
Route::post('/', [LoginController::class, 'create']);
Route::get('/logout', [LogoutController::class, 'logout']);

// Block Route Here 

Route::get('/block_bdashboard', [HomeController::class, 'index'])->middleware(['CheckAuth']);
require __DIR__ . '/add_delay.php';
require __DIR__ . '/add_unemp_allowance.php';
require __DIR__ . '/add_FTO.php';
require __DIR__ . '/state.php';

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
