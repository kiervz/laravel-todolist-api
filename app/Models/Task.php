<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_list_id',
        'title',
        'is_complete'
    ];

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
