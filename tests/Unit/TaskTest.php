<?php

namespace Tests\Unit;

use App\Models\TodoList;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_task_belongs_to_todo_list()
    {
        $list = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $list->id]);

        $this->assertInstanceOf(TodoList::class, $task->todoList);
    }
}
