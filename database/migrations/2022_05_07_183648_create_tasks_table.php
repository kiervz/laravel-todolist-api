<?php

use App\Models\Label;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TodoList::class, 'todo_list_id');
            $table->foreignIdFor(Label::class, 'label_id')->nullable();
            $table->string('title', 191);
            $table->tinyInteger('is_complete')->default(Task::STATUS_NOT_COMPLETE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
