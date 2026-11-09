<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', [TaskController::class, 'index'])->name('home');
Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::resource('tasks', TaskController::class);