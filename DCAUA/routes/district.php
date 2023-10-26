<?php

use App\Http\Controllers\district\DelayCompensationList;
use App\Http\Controllers\district\DistrictController;
use App\Http\Controllers\district\UnempAllowance;
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

// Distrcit Dash Board Page 
Route::group(['middleware' => ['CheckDistrictAuth']], function () {
    // District dashboard Route 

    Route::get('/district_dashboard', [DistrictController::class, 'index']);
    // Delay Compensation Page Route
    Route::get('/district_delay_com', [DelayCompensationList::class, 'index']);
    // Delay Compensation Form List Route
    Route::get('/district_delay_com/form_list', [DelayCompensationList::class, 'form_list']);
    // Delay Compensation View data Route
    Route::get('/district_delay_com/form_data', [DelayCompensationList::class, 'form_data']);
    // Delay Compensation Search List
    Route::post('/district_delay_com/serach_data', [DelayCompensationList::class, 'search_data']);
    // Get Gp Name By Block
    Route::get('district_unemp_allow/get_gp_by_block', [DelayCompensationList::class, 'get_gp_by_block']);
    // Search By Block, Gp And Dates
    Route::post('district_delay_com/search_block_gp_dates', [DelayCompensationList::class, 'search_block_gp_dates']);
    // Unemploment Allowance Page Route 
    Route::get('/district_unemp_allow', [UnempAllowance::class, 'index']);
    // Unemploment Allowance Form List Route
    Route::get('/district_unemp_allow/form_list', [UnempAllowance::class, 'form_list']);
    // Unemploment Allowance View data Route
    Route::get('/district_unemp_allow/form_data', [UnempAllowance::class, 'form_data']);
    // Unemploment Allowance Search List
    Route::post('/district_unemp_allow/serach_data', [UnempAllowance::class, 'search_data']);
    // Search By Block, Gp And Dates
    Route::post('district_unemp_allow/search_block_gp_dates', [UnempAllowance::class, 'search_block_gp_dates']);
    // Approval Delay Compensation List Show
    Route::get('/district_delay_com/approval_list', [DelayCompensationList::class, 'approval_list']);
    // Approval Unemp Allowance List Show
    Route::get('/district_unemp_allow/approval_list', [UnempAllowance::class, 'approval_list']);
    // Delay Load Approval Form List 
    Route::get('/district_delay_com/load_approval_list', [DelayCompensationList::class, 'load_approval_list']);
    // Unemp Load Approval Form List
    Route::get('/district_unemp_allow/load_approval_list', [UnempAllowance::class, 'load_approval_list']);
    // Delay View Approval Form Data
    Route::get('/district_delay_com/view_approval_form', [DelayCompensationList::class, 'view_approval_form']);
    // Unemp View Approval Form Data
    Route::get('/district_unemp_allow/view_approval_form', [UnempAllowance::class, 'view_approval_form']);
    // Delay Approval Form Data
    Route::get('/district_delay_com/approval_form_data', [DelayCompensationList::class, 'approval_form_data']);
    // Unemp Approval Form Data
    Route::get('/district_unemp_allow/approval_form_data', [UnempAllowance::class, 'approval_form_data']);
    // // Get GP By Block Name
    // Route::post('/district_delay_com/get_gp_names', [DelayCompensationList::class, 'get_gp_names']);
    // Delay Search Filter For Approval Page
    Route::post('/district_delay_com/search_approval_filter', [DelayCompensationList::class, 'search_approval_filter']);
});
