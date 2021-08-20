<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Services\AchievementService;
use App\Services\VoteStatusCheckerService;
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
    private $voteChecker;
    private $taskChecker;

    public function __construct(AchievementService $achievementService, VoteStatusCheckerService $voteChecker, TaskService $taskChecker)
    {
        $this->achievementService = $achievementService;
        $this->voteChecker = $voteChecker;
        $this->taskChecker = $taskChecker;
    }

    public function index(Request $request)
    {
        // TODO: 実際にはAuth::user()->idとしてidを取得
        $userId = 1; 

        // ログインユーザーの権限(role)によってuser_idを含めたり含めなかったり?
        $achievements = $this->achievementService->getAchievementsOf($userId);
        
        return response()->success('success', [
            'achievements' => $achievements,
            'is_editable' => $this->voteChecker->isEditable($userId),
        ]);
    }

    public function update(Request $request)
    {
        // TODO: 実際にはAuth::user()->idとしてidを取得
        $userId = 1; 

        // If the user has already taken part in vote, no change will be made.
        if (!$this->voteChecker->isEditable($userId)) {
            return response()->error('Not Editable', Status::HTTP_BAD_REQUEST);
        }

        // 受け取った全てのタスクidが本当に存在するのかの確認
        if (!$this->taskChecker->existAll($request->task_ids)) {
            return response()->error('Invalid task ids', Status::HTTP_BAD_REQUEST);
        }

        // Update achieved tasks
        $isSuccessful = $this->achievementService->renew($userId, $request->task_ids);
        return $isSuccessful ? response()->success('success') : 
                               response()->error('DB error', Status::HTTP_CONFLICT);

    }
}
