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

    public function test_store_task_of_todo_list()
    {
        $list = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $list->id]);

        $this->postJson(route('todo-list.task.store', $list->id), ['title' => $task->title])
            ->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'todo_list_id' => $list->id,
            'title' => $task->title
        ]);
    }

    public function test_update_task_of_todo_list()
    {
        $task = $this->createTask();

        $this->putJson(route('task.update', $task->id), ['title' => 'updated task title'])
            ->assertOk();

        $this->assertDatabaseHas('tasks', ['title' => 'updated task title']);
    }
}
