<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_fetch_all_task_of_todo_list()
    {
        $list = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $list->id]);

        $response = $this->getJson(route('todo-list.task.index', $list->id))
            ->assertStatus(200)
            ->json();

        $this->assertEquals($task->title, $response['response'][0]['title']);
        $this->assertEquals($task->todo_list_id, $response['response'][0]['todo_list_id']);
        $this->assertEquals(1, count($response['response']));
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

    public function test_delete_task_of_todo_list()
    {
        $task = $this->createTask();

        $this->deleteJson(route('task.destroy', $task->id))->assertNoContent();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_store_task_with_label()
    {
        $list = $this->createTodoList();
        $task = $this->createTask();
        $label = $this->createLabel();

        $this->postJson(route('todo-list.task.store', $list['id']), [
            'label_id' => $label['id'],
            'title' => $task['title']
        ])->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => $task['title'],
            'todo_list_id' => $list['id'],
            'label_id' => $label['id']
        ]);
    }

    public function test_if_can_store_task_without_label()
    {
        $list = $this->createTodoList();
        $task = $this->createTask();

        $this->postJson(route('todo-list.task.store', $list['id']), [
            'title' => $task['title']
        ])->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => $task['title'],
            'todo_list_id' => $list['id'],
            'label_id' => null
        ]);
    }
}
