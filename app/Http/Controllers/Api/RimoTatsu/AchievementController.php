<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Http\Requests\AchievementRequest;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as Status; // see details see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use App\Services\AchievementService;
use App\Services\VoteService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    private $achievementService;
    private $voteService;


    public function __construct(AchievementService $achievementService, VoteService $voteService)
    {
        $this->achievementService = $achievementService;
        $this->voteService = $voteService;
    }

    /**
     * ユーザーの達成タスクリストの取得
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); 

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
    public function update(AchievementRequest $request)
    {
        $userId = Auth::id(); 

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
