<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TinhThanhController;
use App\Http\Controllers\Backend\TimKiemController;
use App\Http\Controllers\Backend\DiaDiemController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\QuangCaoController;

/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route Page
Route::get('pages', [PageController::class, 'index'])->name('pages.index');
Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('pages', [PageController::class, 'store'])->name('pages.store');
Route::get('pages/{pages}/', [PageController::class, 'show'])->name('pages.show');
Route::get('pages/{pages}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::patch('pages/{pages}/', [PageController::class, 'update'])->name('pages.update');
Route::delete('pages/{pages}/', [PageController::class, 'destroy'])->name('pages.destroy');

// Route QuangCao
Route::get('quangcaos', [QuangCaoController::class, 'index'])->name('quangcaos.index');
Route::get('quangcaos/create', [QuangCaoController::class, 'create'])->name('quangcaos.create');
Route::post('quangcaos', [QuangCaoController::class, 'store'])->name('quangcaos.store');
Route::get('quangcaos/{quangcaos}/', [QuangCaoController::class, 'show'])->name('quangcaos.show');
Route::get('quangcaos/{quangcaos}/edit', [QuangCaoController::class, 'edit'])->name('quangcaos.edit');
Route::patch('quangcaos/{quangcaos}/', [QuangCaoController::class, 'update'])->name('quangcaos.update');
Route::delete('quangcaos/{quangcaos}/', [QuangCaoController::class, 'destroy'])->name('quangcaos.destroy');

// Route Tỉnh thành
Route::get('tinhthanh', [TinhThanhController::class, 'index'])->name('tinhthanh.index');
Route::get('tinhthanh/create', [TinhThanhController::class, 'create'])->name('tinhthanh.create');
Route::post('tinhthanh', [TinhThanhController::class, 'store'])->name('tinhthanh.store');
Route::get('tinhthanh/{tinhthanh}/', [TinhThanhController::class, 'show'])->name('tinhthanh.show');
Route::get('tinhthanh/{tinhthanh}/edit', [TinhThanhController::class, 'edit'])->name('tinhthanh.edit');
Route::patch('tinhthanh/{tinhthanh}/', [TinhThanhController::class, 'update'])->name('tinhthanh.update');
Route::delete('tinhthanh/{tinhthanh}/', [TinhThanhController::class, 'destroy'])->name('tinhthanh.destroy');

Route::get('timkiem', [TimKiemController::class, 'index'])->name('timkiem');
// Route Địa điểm
Route::get('diadiem', [DiaDiemController::class, 'index'])->name('diadiem.index');
Route::get('diadiem/create', [DiaDiemController::class, 'create'])->name('diadiem.create');
Route::post('diadiem', [DiaDiemController::class, 'store'])->name('diadiem.store');
Route::get('diadiem/{diadiem}/', [DiaDiemController::class, 'show'])->name('diadiem.show');
Route::get('diadiem/{diadiem}/edit', [DiaDiemController::class, 'edit'])->name('diadiem.edit');
Route::patch('diadiem/{diadiem}/', [DiaDiemController::class, 'update'])->name('diadiem.update');
Route::delete('diadiem/{diadiem}/', [DiaDiemController::class, 'destroy'])->name('diadiem.destroy');

