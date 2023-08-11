<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\ViewListController;
use Illuminate\Support\Facades\Route;

Route::get('view_list', [ViewListController::class, 'show_view_list']);
Route::post('view_list', [ViewListController::class, 'post_view_list'])->name('add_child');
Route::post('view_list/add_zero_child', [ViewListController::class, 'add_zero_child_post'])->name('add_zero_child');
Route::post('view_list/review_child_post', [ViewListController::class, 'review_child_post'])->name('review_child');
Route::get('show_em_data', [AdminUserController::class, 'show']);
Route::get('get_gp_name/{block_id}', [AdminUserController::class, 'get_gp']);
Route::get('for_employe_appored', [AdminUserController::class, 'employe_for_approed_get']);
Route::get('for_child_approved', [AdminUserController::class, 'child_for_approved_get']);
Route::get('for_child_img', [AdminUserController::class, 'show_child_img_get']);
Route::post('child_approved', [AdminUserController::class, 'show_child_approved']);
Route::get('testing', [TestingController::class, 'testing_show']);
