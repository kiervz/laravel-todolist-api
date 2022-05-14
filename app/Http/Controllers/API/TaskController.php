<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TaskController extends Controller
{
    public function index(TodoList $todo_list)
    {
        $tasks = Task::where('todo_list_id', $todo_list->id)->get();

        return response($tasks);
    }

    public function store(Request $request, TodoList $todo_list)
    {
        $todo_list->tasks()->create([
            'title' => $request['title']
        ]);

        return response(['message' => 'successfully created'], Response::HTTP_CREATED);
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request['title']
        ]);

        return response(['message' => 'successfully updated'], Response::HTTP_OK);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response(['message' => 'successfully deleted'], Response::HTTP_NO_CONTENT);
    }
}
