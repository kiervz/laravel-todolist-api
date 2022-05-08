<?php

use App\Http\Controllers\API\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('todo-list/{todo_list}/tasks', [TodoListController::class, 'getTasksOfTodoList'])->name('todo-list.getAllTask');
Route::apiResource('todo-list', TodoListController::class);
