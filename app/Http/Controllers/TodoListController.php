<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $list = TodoList::create(['name' => $request['name']]);

        return response($list, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }
}
