<?php

namespace App\Http\Controllers;

use App\Services\TaskSetService;
use Illuminate\Support\Facades\Auth;

class TaskSetController extends Controller
{
    protected $taskSetService;

    public function __construct(TaskSetService $taskSetService)
    {
        $this->taskSetService = $taskSetService;
    }

    public function getTaskSet()
    {
        $task_set = $this->taskSetService->getTasksSet();

        return response()->json([
            'success' => true,
            'data' => $task_set
        ]);
    }

    public function skipTask($task_id)
    {
        $is_task_skipped = $this->taskSetService->skipAndReplaceTask(Auth::id(), $task_id);

        return response()->json([
            'success' => $is_task_skipped,
        ]);
    }

    public function markAsCompleted($task_id)
    {
        $is_task_completed = $this->taskSetService->markAsCompleted($task_id);

        return response()->json([
            'success' => $is_task_completed,
        ]);
    }
}
