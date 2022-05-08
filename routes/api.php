<?php

use App\Http\Controllers\API\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('todo-list/{todo_list}/tasks', [TodoListController::class, 'getTasksOfTodoList'])->name('todo-list.getAllTask');
Route::post('todo-list/tasks', [TodoListController::class, 'storeTask'])->name('todo-list.storeTask');
Route::apiResource('todo-list', TodoListController::class);
