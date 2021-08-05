<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskSet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskSetService
{
    public function getTasksSet()
    {
        $user_id = Auth::id();
        $today = Carbon::today()->format('Y-m-d');

        return $this->getUserTasksSet($user_id, $today);
    }

    public function getUserTasksSet($user_id, $day)
    {
        return TaskSet::where('date', $day)
            ->where('user_id', $user_id)
            ->where('is_skipped', false)
            ->leftJoin('tasks', 'task_sets.task_id', '=', 'tasks.id')
            ->leftJoin('categories', 'tasks.category_id', '=', 'categories.id')
            ->select(
                'task_sets.id',
                'tasks.title',
                'tasks.description',
                'task_sets.is_completed',
                'categories.title as category'
            )
            ->get();
    }

    public function skipAndReplaceTask($user_id, $task_id)
    {
        $task = TaskSet::where('id', $task_id)
            ->where('is_completed', false)
            ->where('is_skipped', false)
            ->first();

        if ($task !== null) {
            $task->is_skipped = true;
            $task->save();

            $today = Carbon::today()->format('Y-m-d');
            $this->generateTask(1, $user_id, $today);

            return true;
        }

        return false;
    }

    public function markAsCompleted($task_id)
    {
        $task = TaskSet::where('id', $task_id)
            ->where('is_completed', false)
            ->where('is_skipped', false)
            ->first();

        if ($task) {
            $task->is_completed = true;
            $task->save();

            return true;
        }

        return false;
    }

    public function generateTask($count, $user_id, $date)
    {
        $new_tasks = Task::whereNotIn('id', function ($query) use ($user_id) {
            $query->select('task_id')
                ->from('task_sets')
                ->where('task_sets.user_id', $user_id)
                ->get();
        })->limit($count)->get();

        foreach ($new_tasks as $task) {
            TaskSet::create([
                'date' => $date,
                'is_skipped' => false,
                'is_completed' => false,
                'user_id' => $user_id,
                'task_id' => $task->id
            ]);
        }
    }

    public function generateDailyTasksSet()
    {
        $today = Carbon::today()->format('Y-m-d');
        $users = User::all();
        $tasks_limit = env('TASKS_LIMIT', 3);

        foreach ($users as $user) {
            $tasks = $this->getUserTasksSet($user->id, $today);
            $count = $tasks_limit - $tasks->count();

            if ($count > 0) {
                $this->generateTask($count, $user->id, $today);
            }
        }
    }
}
