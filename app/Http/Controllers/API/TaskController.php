<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TaskController extends Controller
{
    public function index(TodoList $todo_list)
    {
        $tasks = $todo_list->tasks;

        return response(TaskResource::collection($tasks), Response::HTTP_OK);
    }

    public function store(TaskStoreRequest $request, TodoList $todo_list)
    {
        $todo_list->tasks()->create($request->validated());

        return response(['message' => 'task successfully created'], Response::HTTP_CREATED);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());

        return response(new TaskResource($task), Response::HTTP_OK);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response(['message' => 'task successfully deleted'], Response::HTTP_NO_CONTENT);
    }
}
