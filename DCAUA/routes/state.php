<?php




use App\Http\Controllers\state\ListCeoController;
use App\Http\Controllers\state\AddCEOController;
use App\Http\Controllers\state\AddPOController;
use App\Http\Controllers\state\ListPoController;
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
// Add PO User By State Load Form 
Route::get('/add_po', [AddPOController::class, 'index'])->middleware(['CheckAuth']);
// Add PO User By State Form Submit
Route::post('/add_po', [AddPOController::class, 'add_user']);
// List CEO/PD  Users 
Route::get('/list_ceo', [ListCeoController::class, 'list_ceo'])->middleware(['CheckAuth']);
// List PO Data
Route::get('/list_po', [ListPoCOntroller::class, 'list_po'])->middleware(['CheckAuth']);
// Fetch CEO/PD User List For Datatable 
Route::get('/list_ceo/for_table', [ListCeoController::class, 'for_table'])->middleware(['CheckAuth']);
// Fetch PO User List For Datatable 
Route::get('/list_po/for_table', [ListPoController::class, 'for_table'])->middleware(['CheckAuth']);
// View User CEO Data
Route::get('/list_ceo/view_data', [ListCeoController::class, 'view_data'])->middleware(['CheckAuth']);
// View User PO Data
Route::get('/list_po/view_data', [ListPoController::class, 'view_data'])->middleware(['CheckAuth']);
