<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoList\TodoListStoreRequest;
use App\Http\Requests\TodoList\TodoListUpdateRequest;
use App\Http\Resources\TodoList\TodoListCollection;
use App\Http\Resources\TodoList\TodoListResource;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::where('user_id', auth()->user()->id)->paginate(10);

        return $this->customResponse('result', new TodoListCollection($lists), Response::HTTP_OK);
    }

    public function show(TodoList $todo_list)
    {
        $statusCode = Response::HTTP_OK;
        $message = 'Todo List fetched successfully';
        $data = new TodoListResource($todo_list);

        return $this->customResponse($message, $data, $statusCode);
    }

    public function store(TodoListStoreRequest $request)
    {
        $statusCode = Response::HTTP_CREATED;
        $message = 'Todo List created successfully';

        $list = TodoList::create([
            'user_id' => auth()->user()->id,
            'name' => $request['name']
        ]);

        $data = new TodoListResource($list);

        return $this->customResponse($message, $data, $statusCode);
    }

    public function destroy(TodoList $todo_list)
    {
        $statusCode = Response::HTTP_NO_CONTENT;
        $message = 'Todo List deleted successfully';

        $todo_list->tasks->each->delete();
        $todo_list->delete();

        return $this->customResponse($message, '', $statusCode);
    }

    public function update(TodoListUpdateRequest $request, TodoList $todo_list)
    {
        $statusCode = Response::HTTP_OK;
        $message = 'Todo List updated successfully';

        $todo_list->update($request->all());
        $data = new TodoListResource($todo_list);

        return $this->customResponse($message, $data, $statusCode);
    }
}
