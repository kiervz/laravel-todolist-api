<?php

namespace Tests\Unit;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTodoListTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_many_todo_lists()
    {
        $user = $this->createUser();
        $this->createTodoList(['user_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->todoLists);
        $this->assertInstanceOf(TodoList::class, $user->todoLists->first());
    }
}
