<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseApiController;
use App\Http\Controllers\Member\MemberPaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('maintenance.middleware')->group(function () {
    // Route::get('v1/course/', [CourseApiController::class, 'course'])->name('api.course.query');
    //  Route::get('v1/course/category/', [CourseApiController::class, 'filterCourseCategory'])->name('api.course.query.category');
    // Route::get('v1/category', [CourseApiController::class, 'category'])->name('api.category');
    // Route::get('v1/course/chapter/', [CourseApiController::class, 'chapter'])->name('api.course.chapter');
    Route::post('/webhook/transaction', [MemberPaymentController::class, 'checkout'])->name('member.webhook.transaction');
});
