<?php

use App\Http\Controllers\AiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AiController::class, 'index'])->name('index');
Route::post('/send', [AiController::class, 'store'])->name('send.message'); 