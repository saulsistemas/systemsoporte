<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});
Route::get('home',[HomeController::class,'index'])->name('home');
Route::resource('users', UserController::class)->names('users');
Route::get('users/{id}/restore', [UserController::class,'restore'])->name('users.restore');
Route::resource('roles', RoleController::class)->names('roles');
Route::resource('projects', ProjectController::class)->names('projects');
Route::get('projects/{id}/restore', [ProjectController::class,'restore'])->name('projects.restore');
#Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
#    return view('dashboard');
#})->name('dashboard');
