<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;

class AchievementController extends Controller
{

    public function index(Request $request)
    {
        // テスト用。実際にはAuth::user()->idとしてidを取得
        $userId = 2; 

        // ログインユーザーの権限(role)によってuser_idを含めたり含めなかったり?
        $achievements = Achievement::exclude('user_id')
                        ->where('user_id', $userId)
                        ->orderBy('task_id')
                        ->get();
        
        return response()->success('success', [
            'achievements' => $achievements,
            'is_editable' => $this->isEditable($userId),
        ]);
    }

    public function update(Request $request)
    {
        // テスト用。実際にはAuth::user()->idとしてidを取得
        $userId = 2; 

        // TODO: 全てdeleteして、新しくinsert
        
        return response()->success();
    }

    // TODO: votesに参加しているかどうかによって、true/falseを返す
    private function isEditable($userId)
    {
        return true;
    }
}
