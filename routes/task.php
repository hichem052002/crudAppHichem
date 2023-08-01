<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('tasks/index/{role}/{user}', [TaskController::class, 'indexUser'])->name('tasks.indexUser')->middleware(AuthMiddleware::class);



//Route::get('tasks/index/{user}/{role}/search', [TaskController::class, 'search'])->name('task.search');

