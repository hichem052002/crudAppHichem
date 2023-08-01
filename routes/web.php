<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/signup', [LoginController::class, 'sign_up'])->name('signup');
Route::post('/login/check', [LoginController::class, 'check'])->name('login.check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('tasks/')->group(function () {
    Route::get('create/{admin}', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('store/{admin}', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('edit/{id}/{admin}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('update/{task}/{admin}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('delete/{id}/{admin}', [TaskController::class, 'destroy'])->name('tasks.delete');
})->middleware(LoginMiddleware::class);

Route::prefix('users/')->group(function () {
    Route::get('register', [UserController::class, 'create'])->name('users.register');
    Route::post('store', [UserController::class, 'store'])->name('users.store');
    Route::get('index', [UserController::class, 'index'])->name('users.index');
    Route::put('update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('{id}', [UserController::class, 'delete'])->name('users.delete');
})->middleware(LoginMiddleware::class);

Route::prefix('projects/')->group(function () {
    Route::get('index', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('search', [ProjectController::class, 'search'])->name('projects.search');
    Route::get('create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('update/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('delete/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');
})->middleware(LoginMiddleware::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
