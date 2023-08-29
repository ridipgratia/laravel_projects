<?php

use App\Http\Controllers\leaveHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/leave-history', [leaveHistoryController::class, 'leave_history'])->middleware(['auth']);
Route::get('/leave-history-date', [leaveHistoryController::class, 'leave_history_date'])->middleware(['auth']);
Route::get('/review-leave-application', [leaveHistoryController::class, 'review_leave_application'])->middleware(['auth']);
Route::get('/remove-leave-application', [leaveHistoryController::class, 'remove_leave_application'])->middleware(['auth']);
Route::get('/leave-medical-file', [leaveHistoryController::class, 'leave_medical_file'])->middleware(['auth']);
