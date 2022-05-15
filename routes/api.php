<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('todo-list', TodoListController::class);
Route::apiResource('todo-list.task', TaskController::class)
    ->except('show')
    ->shallow();

Route::post('/register', RegisterController::class)->name('auth.register');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
