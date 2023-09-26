<?php

use App\Http\Controllers\AddFTOController;
use App\Http\Controllers\HomeController;
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
Route::get('/', [HomeController::class, 'index']);
require __DIR__ . '/add_delay.php';
require __DIR__ . '/add_unemp_allowance.php';
require __DIR__ . '/add_FTO.php';
