<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'is_completed',
        'is_skipped',
        'user_id',
        'task_id'
    ];
}
