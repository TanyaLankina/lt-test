<?php

namespace App\Console\Commands;

use App\Services\TaskSetService;
use Illuminate\Console\Command;

class GenerateDailyTasksSets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generateDailyTasksSets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $taskSetService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TaskSetService $taskSetService)
    {
        parent::__construct();

        $this->taskSetService = $taskSetService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->taskSetService->generateDailyTasksSet();

        return 0;
    }
}
