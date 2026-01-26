<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UiController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DesainController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/design', [DesainController::class, 'index'])->name('design');

Route::get('/video', [VideoController::class, 'index'])->name('video');

Route::get('/game', [GameController::class, 'index'])->name('game');

Route::get('/ui', [UiController::class, 'index'])->name('ui');