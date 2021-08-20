<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Achievement;
use Carbon\Carbon;

class AchievementService
{
    public function getAchievementsOf($userId) 
    {
        return Achievement::exclude('user_id')
                        ->where('user_id', $userId)
                        ->orderBy('task_id')
                        ->get();
    }

    public function renew($userId, $taskIds)
    {
        DB::beginTransaction();
        try {
            Achievement::where('user_id', $userId)->delete();
            $insertData = array();
            foreach ($taskIds as $taskId) {
                array_push($insertData, ['user_id' => $userId, 'task_id' => $taskId, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            Achievement::insert($insertData);
            DB::commit();
            return true;
        } catch(QueryException $e) {
            DB::rollback();
            return false;
        }
    }
}