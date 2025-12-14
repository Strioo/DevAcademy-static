<?php

use Illuminate\Support\Facades\Route;

// Member routes - Public & Auth
use App\Http\Controllers\Member\Auth\MemberLoginController;
use App\Http\Controllers\Member\Auth\MemberRegisterController;
use App\Http\Controllers\Member\Auth\ResendEmailVerif as MemberResendEmailController;
use App\Http\Controllers\Member\Auth\forgotPassController as MemberForgotPassController;
use App\Http\Controllers\Member\Dashboard\MemberSettingController;
use App\Http\Controllers\Member\LandingpageController as MemberLandingPagesController;
use App\Http\Controllers\Member\Dashboard\MemberMyCourseController;
use App\Http\Controllers\Member\MemberPaymentController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\Member\MemberReviewController;
use App\Http\Controllers\Member\Courses\MemberCourseController;

/*
|--------------------------------------------------------------------------
| Web Routes - Portfolio Frontend Version
|--------------------------------------------------------------------------
|
| Project DevAcademy telah dioptimasi untuk portfolio frontend.
| Semua route admin/superadmin telah dihapus permanen.
| Data ditampilkan menggunakan DummyData (app/DummyData/).
|
| Route yang tersedia:
| - Public pages (landing, courses)
| - Member auth (login, register, forgot password)
| - Member dashboard (my courses, settings, transactions)
|
|--------------------------------------------------------------------------
*/



Route::get('/', [MemberLandingPagesController::class, 'index'])->name('home');
Route::view('/eror/pages', 'error.page404')->name('pages.error');

Route::prefix('member')->group(function () {

    // member course
    Route::prefix('course')->group(function () {
        Route::get('/', [MemberCourseController::class, 'index'])->name('member.course')->middleware('students');
        Route::get('join/{slug}', [MemberCourseController::class, 'join'])->name('member.course.join')->middleware('students');
        Route::get('{slug}/play/episode/{episode}', [MemberCourseController::class, 'play'])->name('member.course.play')->middleware('students');
        Route::get('detail/{slug}', [MemberCourseController::class, 'detail'])->name('member.course.detail')->middleware('students');
        Route::get('detail/sertifikat/{slug}', [MemberCourseController::class, 'generateSertifikat'])->name('member.sertifikat')->middleware('students');
    });

    Route::prefix('review')->middleware('students')->group(function () {
        Route::get('{slug}', [MemberReviewController::class, 'index'])->name('member.review');
        Route::post('store', [MemberReviewController::class, 'store'])->name('member.review.store');
        Route::get('ebook/{slug}', [MemberReviewController::class, 'ebookFormReview'])->name('member.review.ebook');
        Route::post('ebook/store', [MemberReviewController::class, 'storeReviewEbook'])->name('member.review.ebook.store');
    });

    Route::prefix('payment')->middleware('students')->group(function () {
        Route::get('payment/', [MemberPaymentController::class, 'index'])->name('member.payment');
        Route::post('payment/store', [MemberPaymentController::class, 'store'])->name('member.transaction.store');
    });

    // dashboard mycourse
    Route::get('/', [MemberMyCourseController::class, 'index'])->name('member.dashboard')->middleware('students');
    // dashboard setting member
    Route::prefix('setting')->middleware('students')->group(function () {
        Route::view('/', 'member.dashboard.setting.view')->name('member.setting');

        Route::view('profile', 'member.dashboard.setting.edit-profile')->name('member.setting.profile');
        Route::put('profile/updated', [MemberSettingController::class, 'updateProfile'])->name('member.setting.profile.updated');

        Route::view('change-email', 'member.dashboard.setting.edit-email')->name('member.setting.change-email');
        Route::put('change-email/updated', [MemberSettingController::class, 'updateEmail'])->name('member.setting.change-email.updated');

        Route::view('reset-password', 'member.dashboard.setting.edit-password')->name('member.setting.reset-password');
        Route::put('reset-password/updated', [MemberSettingController::class, 'updatePassword'])->name('member.setting.reset-password.updated');
    });

    // My transaction
    Route::prefix('transaction')->group(function () {
        Route::get('/', [MemberTransactionController::class, 'index'])->name('member.transaction');
        Route::delete('/cancel/{id}', [MemberTransactionController::class, 'cancel'])->name('member.transaction.cancel');
        Route::get('/detail/{transaction_code}', [MemberTransactionController::class, 'show'])->name('member.transaction.view-transaction');
    });


    Route::view('login', 'member.auth.login')->name('member.login');
    Route::post('login/auth', [MemberLoginController::class, 'login'])->name('member.login.auth');

    Route::get('register', [MemberRegisterController::class, 'index'])->name('member.register');
    Route::post('register/store', [MemberRegisterController::class, 'store'])->name('member.register.store');

    // logout
    Route::get('user/logout', [MemberLoginController::class, 'logout'])->name('member.logout');

    // Halaman verifikasi email
    Route::get('/email/verify', [MemberResendEmailController::class, 'index'])->name('verification.notice');

    // Mengirim ulang email verifikasi
    Route::post('/email/resend', [MemberResendEmailController::class, 'resend'])->middleware('auth')->name('verification.resend');

    // Menangani verifikasi email dari link
    Route::get('/email/verify/{id}/{hash}', [MemberResendEmailController::class, 'handler'])
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

    // route halaman send reset oassword
    Route::get('forget-password', [MemberForgotPassController::class, 'index'])->name('member.forget-password');

    Route::post('forget-password/check', [MemberForgotPassController::class, 'checkEmail'])->middleware(['throttle:custom-limit-reset-pw'])->name('member.forget-password.check');

    // kirim link reset password
    Route::get('/reset-password/{token}', [MemberForgotPassController::class, 'sendResetLinkPassword'])->name('password.reset');
    Route::post('/reset-password/updated', [MemberForgotPassController::class, 'resetPassword'])->name('member.reset-password.updated');
});
