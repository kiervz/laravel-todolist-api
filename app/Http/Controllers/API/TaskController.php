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

        return $this->customResponse('result', TaskResource::collection($tasks), Response::HTTP_OK);
    }

    public function store(TaskStoreRequest $request, TodoList $todo_list)
    {
        $statusCode = Response::HTTP_CREATED;
        $message = 'Task created successfully';

        $task = $todo_list->tasks()->create($request->validated());
        $data = new TaskResource($task);

        return $this->customResponse($message, $data, $statusCode);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $statusCode = Response::HTTP_OK;
        $message = 'Task updated successfully';

        $task->update($request->validated());
        $data = new TaskResource($task);

        return $this->customResponse($message, $data, $statusCode);
    }

    public function destroy(Task $task)
    {
        $statusCode = Response::HTTP_NO_CONTENT;
        $message = 'Task deleted successfully';

        $task->delete();

        return $this->customResponse($message, '', $statusCode);
    }
}
