<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DiaDiemController;
use App\Http\Controllers\Frontend\DacSanController;
use App\Http\Controllers\Frontend\TourDuLichController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

// Pages
Route::get('pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// Tour Du lịch
Route::get('/tourdulich', [TourDuLichController::class, 'index'])->name('tourdulich.index');
Route::get('tourdulich/{tourdulich}/', [TourDuLichController::class, 'show'])->name('tourdulich.show');
Route::post('tourdulich/{tourdulich}/goidanhgia/', [TourDuLichController::class, 'goidanhgia'])->name('tourdulich.goidanhgia');

// Địa điểm
Route::get('/diadiem', [DiaDiemController::class, 'index'])->name('diadiem.index');
Route::get('diadiem/{diadiem}/', [DiaDiemController::class, 'show'])->name('diadiem.show');
Route::post('diadiem/{diadiem}/goidanhgia/', [DiaDiemController::class, 'goidanhgia'])->name('diadiem.goidanhgia');

// Đặc sản
Route::get('/dacsan', [DacSanController::class, 'index'])->name('dacsan.index');
Route::get('dacsan/{dacsan}/', [DacSanController::class, 'show'])->name('dacsan.show');
Route::post('dacsan/{dacsan}/goidanhgia/', [DacSanController::class, 'goidanhgia'])->name('dacsan.goidanhgia');

// Search
Route::post('timkiem', [HomeController::class, 'search'])->name('search');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', [AccountController::class, 'index'])->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});
