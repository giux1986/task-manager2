<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

// Protected routes
Route::group(['middleware' => ['auth:api']], function () {

    // Tasks
    Route::get('/tasks', 'TaskController@index');
    Route::get('/tasks/{task}', 'TaskController@show');
    Route::post('/tasks', 'TaskController@store');
    Route::put('/tasks/{task}', 'TaskController@update');
    Route::delete('/tasks/{task}', 'TaskController@delete');

    // Task groups
    Route::get('/task-groups', 'TaskGroupController@index');
    Route::get('/task-groups/{taskGroup}', 'TaskGroupController@show');
    Route::post('/task-groups', 'TaskGroupController@store');
    Route::put('/task-groups/{taskGroup}', 'TaskGroupController@update');
    Route::delete('/task-groups/{taskGroup}', 'TaskGroupController@delete');

    // User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
