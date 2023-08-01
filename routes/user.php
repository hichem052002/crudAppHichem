<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\LoginMiddleware;

Route::get('/users/edit/{role}/{user}',[UserController::class,'edit'])->name('users.edit')->middleware(AuthMiddleware::class);


