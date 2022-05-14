<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(TodoList $todo_list)
    {
        $tasks = Task::where('todo_list_id', $todo_list->id)->get();

        return response($tasks);
    }
}
