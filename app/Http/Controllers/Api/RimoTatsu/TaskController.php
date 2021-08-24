<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as Status; // see details see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use Illuminate\Database\QueryException;
use \Symfony\Component\HttpFoundation\Response as Status; // see Details https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798

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
        try {
            return response()->success('success', [
                "tasks" => $this->taskService->getAll(),
            ]);
        } catch(QueryException $e) {
            return response()->error('DB error', Status::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
