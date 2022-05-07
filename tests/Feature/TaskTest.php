<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $list;

    public function setUp():void
    {
        parent::setUp();
        $this->list = TodoList::factory()->create(['name' => 'my list']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetch_all_task_of_todo_list()
    {
        $this->getJson(route('todo-list.getAllTask', $this->list->id))
            ->assertStatus(200);
    }
}
