<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_all_todo_list()
    {
        // preparation - prepare
        TodoList::factory()->create();

        // action - perform
        $response = $this->getJson(route('todo-list.index'));

        // assertion - predict
        $this->assertEquals(1, count($response->json()));
    }
}
