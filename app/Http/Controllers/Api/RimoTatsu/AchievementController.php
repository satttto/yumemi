<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Services\AchievementService;
use App\Services\VoteService;
use App\Services\TaskService;
use Illuminate\Http\Request;
/** 
 * status code
 * see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
 */
use \Symfony\Component\HttpFoundation\Response as Status;

class AchievementController extends Controller
{
    private $achievementService;
    private $voteService;
    private $taskService;

    public function __construct(AchievementService $achievementService, VoteStatusCheckerService $voteService, TaskService $taskService)
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
        $userId = 1; 

        // ユーザーの達成項目取得
        $achievements = $this->achievementService->getAchievementsOf($userId);
        
        return response()->success('success', [
            'achievements' => $achievements,
            'is_editable' => $this->voteService->isEditable($userId),
        ]);
    }

    /**
     * ユーザーの達成タスクリストの変更
     */
    public function update(Request $request)
    {
        // TODO: 実際にはAuth::user()->idとしてidを取得
        $userId = 1; 

        // 既に宝くじに参加しているかどうかの確認(Yesなら変更不可)
        if (!$this->voteService->isEditable($userId)) {
            return response()->error('Not Editable', Status::HTTP_BAD_REQUEST);
        }

        // 受け取った全てのタスクidが本当に存在するのかの確認
        if (!$this->taskService->existAll($request->task_ids)) {
            return response()->error('Invalid task ids', Status::HTTP_BAD_REQUEST);
        }

        // ユーザーのタスクの更新
        $isSuccessful = $this->achievementService->renew($userId, $request->task_ids);
        return $isSuccessful ? response()->success('success') : 
                               response()->error('DB error', Status::HTTP_CONFLICT);

    }
}
