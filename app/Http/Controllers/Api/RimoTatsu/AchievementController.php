<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Services\AchievementService;
use App\Services\VoteService;
use App\Services\TaskService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as Status; // see details see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use Illuminate\Database\QueryException;

class AchievementController extends Controller
{
    private $achievementService;
    private $voteService;
    private $taskService;

    public function __construct(AchievementService $achievementService, VoteService $voteService, TaskService $taskService)
    {
        $this->achievementService = $achievementService;
        $this->voteService = $voteService;
        $this->taskService = $taskService;
    }

    /**
     * ユーザーの達成タスクリストの取得
     */
    public function index(Request $request)
    {
        // TODO: 実際にはAuth::user()->idとしてidを取得
        $userId = 3; 

        // ユーザーの達成項目取得
        try {
            return response()->success('succeeded to retrieve achievements', [
                'achievements' => $this->achievementService->getAchievementsOf($userId),
                'is_editable' => $this->voteService->isEditable($userId),
            ]);
        } catch(QueryException $e) {
            return response()->error('failed to retrieve achievements', Status::HTTP_BAD_REQUEST);
        }
    }

    /**
     * ユーザーの達成タスクリストの変更
     */
    public function update(Request $request)
    {
        // TODO: 実際にはAuth::user()->idとしてidを取得
        $userId = 4; 

        // TODO: バリデーションにする
        // 受け取った全てのタスクidが本当に存在するのかの確認
        if (!$this->taskService->existAll($request->task_ids)) {
            return response()->error('Invalid task ids', Status::HTTP_BAD_REQUEST);
        }

        // 既に宝くじに参加しているかどうかの確認(Yesなら変更不可)
        try {
            if (!$this->voteService->isEditable($userId)) {
                return response()->error('Not Editable', Status::HTTP_BAD_REQUEST);
            }
        } catch(QueryException $e) {
            return response()->error('DB error');
        }

        // ユーザーのタスクの更新
        try {
            DB::beginTransaction();
            $this->achievementService->renew($userId, $request->task_ids);
            DB::commit();
            return response()->success('updated achievements');
        } catch(QueryException $e) {
            DB::rollback();
            return response()->error('failed to update', Status::HTTP_BAD_REQUEST);
        }
    }
}
