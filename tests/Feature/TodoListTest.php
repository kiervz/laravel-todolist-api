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
        $this->list = TodoList::factory()->create(['name' => 'my list']);
    }

    public function test_index_all_todo_list()
    {
        $response = $this->getJson(route('todo-list.index'));

        $this->assertEquals(1, count($response->json()));
    }

    public function test_fetch_single_todo_list()
    {
        $response = $this->getJson(route('todo-list.show', $this->list->id))
                    ->assertOk()
                    ->json();

        $this->assertEquals($response['name'], $this->list->name);
    }

    public function test_store_todo_list()
    {
        $list = TodoList::factory()->make();

        $response = $this->postJson(route('todo-list.store'), ['name' => $list['name']])
            ->assertCreated()
            ->json();

        $this->assertEquals($list['name'], $response['name']);
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

    public function test_fetch_all_task_of_todo_list()
    {
        $this->getJson(route('todo-list.getAllTask', $this->list->id))
            ->assertStatus(200);
    }

    public function test_store_task_of_todo_list()
    {
        $data = [
            'todo_list_id' => $this->list->id,
            'title' => 'Eat hamburger',
            'is_complete' => 0
        ];

        $this->postJson(route('todo-list.storeTask'), $data)
            ->assertCreated();
    }
}
