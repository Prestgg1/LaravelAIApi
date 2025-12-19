<?php

use App\Http\Controllers\AiChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AiChatController::class, 'index'])->name('index');
Route::post('/send', [AiChatController::class, 'store'])->name('send.message'); 