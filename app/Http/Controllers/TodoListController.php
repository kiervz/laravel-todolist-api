<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoList\TodoListStoreRequest;
use App\Http\Requests\TodoList\TodoListUpdateRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::all();

        return response($lists);
    }

    public function show(TodoList $todo_list)
    {
        return response($todo_list, Response::HTTP_OK);
    }

    public function store(TodoListStoreRequest $request)
    {
        $list = TodoList::create($request->all());

        return response($list, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(TodoListUpdateRequest $request, TodoList $todo_list)
    {
        $todo_list->update($request->all());

        return response($todo_list);
    }
}
