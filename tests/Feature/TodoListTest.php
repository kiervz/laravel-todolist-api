<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $list;

    public function setUp():void
    {
        parent::setUp();
        $user = $this->authUser();
        $this->list = $this->createTodoList([
            'user_id' => $user->id,
            'name' => 'my list'
        ]);
    }

    public function test_index_all_todo_list()
    {
        $this->createTodoList();
        $response = $this->getJson(route('todo-list.index'))->json();

        $this->assertEquals(1, count($response['response']['data']));
    }

    public function test_fetch_single_todo_list()
    {
        $response = $this->getJson(route('todo-list.show', $this->list->id))
                    ->assertOk()
                    ->json();

        $this->assertEquals($response['response']['name'], $this->list->name);
    }

    public function test_store_todo_list()
    {
        $list = TodoList::factory()->make();

        $response = $this->postJson(route('todo-list.store'), [
            'user_id' => $list['user_id'],
            'name' => $list['name']
        ])->assertCreated()
        ->json();

        $this->assertEquals($list['name'], $response['response']['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list['name']]);
    }

    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy', $this->list->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);
    }

    public function test_update_todo_list()
    {
        $data = ['name' => 'updated name'];

        $this->putJson(route('todo-list.update', $this->list->id), $data)
            ->assertOk();

        $this->assertDatabaseHas('todo_lists', [
            'id' => $this->list->id,
            'name' => 'updated name'
        ]);
    }

    public function test_if_todo_list_is_deleted_then_all_its_task_will_be_deleted()
    {
        $list = $this->createTodoList();
        $this->createTask(['todo_list_id' => $list->id]);

        $this->deleteJson(route('todo-list.destroy', $list->id))->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['id' => $list->id]);
    }
}
