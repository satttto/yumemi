<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * タスク一覧の取得
     */
    public function index(Request $request) 
    {
        // 全てのタスクを取得
        $tasks = $this->taskService->getAll();
                    
        return response()->success('success', ["tasks" => $tasks]);
    }

}
