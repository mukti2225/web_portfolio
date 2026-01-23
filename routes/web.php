<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/design', [HomeController::class, 'design'])->name('design');

Route::get('/video', [HomeController::class, 'video'])->name('video');

Route::get('/game', [HomeController::class, 'game'])->name('game');

Route::get('/ui', [HomeController::class, 'ui'])->name('ui');