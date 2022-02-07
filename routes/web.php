<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});
Route::get('home',[HomeController::class,'index'])->name('home');
Route::resource('users', UserController::class)->names('users');
Route::get('users/{id}/restore', [UserController::class,'restore'])->name('users.restore');
#Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
#    return view('dashboard');
#})->name('dashboard');
