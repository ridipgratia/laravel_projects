<?php




use App\Http\Controllers\state\ListCeoController;
use App\Http\Controllers\state\AddCEOController;
use App\Http\Controllers\state\AddPOController;
use App\Http\Controllers\state\ListPoController;
use App\Http\Controllers\StateController;
use Illuminate\Queue\ListenerOptions;
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

Route::group(['middleware' => ['CheckStateAuth']], function () {


    Route::get('/state_dash', [StateController::class, 'index']);

    // Add CEO Pd User By State Load Form
    Route::get('/add_ceo', [AddCEOController::class, 'index']);
    // Add CEO PD User By State Form Submit
    Route::post('/add_ceo', [AddCEOController::class, 'add_user']);
    // Add PO User By State Load Form 
    Route::get('/add_po', [AddPOController::class, 'index']);
    // Add PO User By State Form Submit
    Route::post('/add_po', [AddPOController::class, 'add_user']);
    // List CEO/PD  Users 
    Route::get('/list_ceo', [ListCeoController::class, 'list_ceo']);
    // List PO Data
    Route::get('/list_po', [ListPoCOntroller::class, 'list_po']);
    // Fetch CEO/PD User List For Datatable 
    Route::get('/list_ceo/for_table', [ListCeoController::class, 'for_table']);
    // Fetch PO User List For Datatable 
    Route::get('/list_po/for_table', [ListPoController::class, 'for_table']);
    // View User CEO Data
    Route::get('/list_ceo/view_data', [ListCeoController::class, 'view_data']);
    // View User PO Data
    Route::get('/list_po/view_data', [ListPoController::class, 'view_data']);
    // Reset CEO User Password 
    Route::get('/list_ceo/reset_pass', [ListCeoController::class, 'reset_pass']);
    // Reset PO User Password
    Route::get('/list_po/reset_pass', [ListPoController::class, 'reset_pass']);
    // Remove CEO PD User 
    Route::get('/list_ceo/remove_user', [ListCeoController::class, 'remove_user']);
    // Remove PO User
    Route::get('/list_po/remove_user', [ListPoController::class, 'remove_user']);
    // Edit CEO PD User
    Route::get('/list_ceo/edit_user', [ListCeoController::class, 'edit_user']);
    // Edit PO User
    Route::get('/list_po/edit_user', [ListPoController::class, 'edit_user']);
    // Edit CEO PD User Submit 
    Route::post('/list_ceo/edit_user_submit', [ListCeoController::class, 'edit_user_submit']);
    // Edit Po User submit
    Route::post('/list_po/edit_user_submit', [ListPoController::class, 'edit_user_submit']);
});
