<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;

Route::get('home',[HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');
Route::resource('users', UserController::class)->names('admin.users');
Route::get('users/{id}/restore', [UserController::class,'restore'])->name('admin.users.restore');
Route::resource('roles', RoleController::class)->names('admin.roles');
Route::resource('projects', ProjectController::class)->names('admin.projects');
Route::get('projects/{id}/restore', [ProjectController::class,'restore'])->name('admin.projects.restore');
?>