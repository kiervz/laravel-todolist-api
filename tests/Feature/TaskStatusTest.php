<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_task_can_update_status_to_completed()
    {
        $task = $this->createTask();

        $this->putJson(route('task.update', $task->id), ['is_complete' => Task::STATUS_COMPLETE]);

        $this->assertDatabaseHas('tasks', ['is_complete' => Task::STATUS_COMPLETE]);
    }
}
