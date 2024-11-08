<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('/locations', LocationController::class)->only(['index', 'create', 'store']);

Route::resource('/brands', BrandController::class)->only(['store']);

Route::resource('/flavors', FlavorController::class)->only(['store']);

Route::get('/rankings', RankingController::class)->name('rankings');

require __DIR__.'/auth.php';
