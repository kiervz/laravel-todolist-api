<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(TodoList $todo_list)
    {
        return response($todo_list->load('tasks'));
    }
}
