<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_task_of_todo_list()
    {
        $list = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $list->id]);

        $response = $this->getJson(route('todo-list.task.index', $list->id))
            ->assertStatus(200)
            ->json();

        $this->assertEquals($task->title, $response[0]['title']);
        $this->assertEquals($task->todo_list_id, $response[0]['id']);
    }
}
