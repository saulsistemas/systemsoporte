<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\LevelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;

Route::get('home',[HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');
Route::resource('users', UserController::class)->names('admin.users');
Route::get('users/{id}/restore', [UserController::class,'restore'])->name('admin.users.restore');
Route::get('users/{id}/offices', [UserController::class,'officesAll'])->name('admin.users.officesAll');
Route::get('users/{id}/areas', [UserController::class,'areasAll'])->name('admin.users.areasAll');
Route::resource('roles', RoleController::class)->names('admin.roles');
Route::resource('projects', ProjectController::class)->names('admin.projects');
Route::get('projects/{id}/restore', [ProjectController::class,'restore'])->name('admin.projects.restore');
Route::resource('levels', LevelController::class)->names('admin.levels');
Route::resource('areas', AreaController::class)->names('admin.areas');
Route::get('areas/{id}/restore', [AreaController::class,'restore'])->name('admin.areas.restore');
Route::resource('tickets', TicketController::class)->names('admin.tickets');
Route::get('tickets/{id}/categories', [TicketController::class,'categoriesAll'])->name('admin.tickets.categoriesAll');
Route::get('tickets/{id}/subcategories', [TicketController::class,'subcategoriesAll'])->name('admin.tickets.subcategoriesAll');

Route::get('tickets/{ticket}/atender', [TicketController::class,'atender'])->name('admin.tickets.atender');
Route::put('tickets/{ticket}/resolver', [TicketController::class,'resolver'])->name('admin.tickets.resolver');
Route::get('tickets/{ticket}/abrir', [TicketController::class,'abrir'])->name('admin.tickets.abrir');
Route::get('tickets/{ticket}/derivar', [TicketController::class,'derivar'])->name('admin.tickets.derivar');



?>