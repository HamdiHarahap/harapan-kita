<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::post('/donate', [DonationController::class, 'store'])->name('donate');
Route::get('/kegiatan', [HomeController::class, 'kegiatan'])->name('kegiatan');
Route::get('/kegiatan/{slug}', [HomeController::class, 'detail'])->name('detail');