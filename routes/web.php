<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('/locations', LocationController::class);

Route::resource('/brands', BrandController::class)->only(['store']);

Route::resource('/flavors', FlavorController::class)->only(['store']);

require __DIR__.'/auth.php';
