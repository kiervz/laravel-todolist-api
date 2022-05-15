<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\TodoListController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('todo-list', TodoListController::class);
    Route::apiResource('todo-list.task', TaskController::class)
        ->except('show')
        ->shallow();

    Route::get('/me', [UserController::class, 'me']);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::apiResource('survey', SurveyController::class);
});

Route::post('/register', RegisterController::class)->name('auth.register');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
