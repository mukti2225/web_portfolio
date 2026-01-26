<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DesainController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/design', [DesainController::class, 'index'])->name('design');

Route::get('/video', [VideoController::class, 'index'])->name('video');

Route::get('/game', [HomeController::class, 'index'])->name('game');

Route::get('/ui', [HomeController::class, 'index'])->name('ui');