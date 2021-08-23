<?php

namespace App\Services;

use App\Models\Achievement;
use Carbon\Carbon;

class AchievementService
{
    /**
     * 該当ユーザーの達成タスクリストを取得
     * 
     * @param integer $userId - 該当ユーザーのid
     * @return collection - task_id, created_at, updated_at
     */
    public function getAchievementsOf($userId) 
    {
        return Achievement::exclude('user_id')
                        ->where('user_id', $userId)
                        ->orderBy('task_id')
                        ->get();
    }

    /**
     * ユーザーの達成タスクの更新
     * 
     * 一度そのユーザーに該当するタスクを全て削除してから、
     * (重複しているのも含めて)追加し直す
     * @param integer $userId - ユーザーid
     * @param integer[] $taskIds - 達成項目(差分ではなく、ユーザーが達成したタスク全て)
     * @return boolean - true if succeeded
     */
    public function renew($userId, $taskIds)
    {
        Achievement::where('user_id', $userId)->delete();
        $insertData = array();
        foreach ($taskIds as $taskId) {
            array_push($insertData, ['user_id' => $userId, 'task_id' => $taskId, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
        Achievement::insert($insertData);
    }
}