<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('todo-list', TodoListController::class);
Route::get('todo-list/{todo_list}/task', [TaskController::class, 'index'])->name('todo-list.getAllTask');
