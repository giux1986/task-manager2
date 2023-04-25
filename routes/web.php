<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskGroupController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    
    Route::get('/task-groups', [TaskGroupController::class, 'index'])->name('task-groups.index');
    Route::get('/task-groups/create', [TaskGroupController::class, 'create'])->name('task-groups.create');
    Route::post('/task-groups', [TaskGroupController::class, 'store'])->name('task-groups.store');
    Route::get('/task-groups/{taskGroup}/edit', [TaskGroupController::class, 'edit'])->name('task-groups.edit');
    Route::patch('/task-groups/{taskGroup}', [TaskGroupController::class, 'update'])->name('task-groups.update');
    Route::delete('/task-groups/{taskGroup}', [TaskGroupController::class, 'destroy'])->name('task-groups.destroy');

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
});
