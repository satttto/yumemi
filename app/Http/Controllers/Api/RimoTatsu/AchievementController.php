<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/** 
 * status code
 * see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
 */
use \Symfony\Component\HttpFoundation\Response as Status;
use App\Models\Achievement;

class AchievementController extends Controller
{

    public function index(Request $request)
    {
        // TODO: 実際にはAuth::user()->idとしてidを取得
        $userId = 2; 

        // ログインユーザーの権限(role)によってuser_idを含めたり含めなかったり?
        $achievements = Achievement::exclude('user_id')
                        ->where('user_id', $userId)
                        ->orderBy('task_id')
                        ->get();
        
        // TODO: service に書き換える。
        return response()->success('success', [
            'achievements' => $achievements,
            'is_editable' => $this->isEditable($userId),
        ]);
    }

    public function update(Request $request)
    {
        // TODO: 実際にはAuth::user()->idとしてidを取得
        $userId = 2; 

        // If the user has already taken part in vote, no change will be made.
        if (!$this->isEditable($userId)) {
            return response()->error('Not Editable', Status::HTTP_BAD_REQUEST);
        }

        // TODO: 本当にtask_idが存在するかの確認
        // TODO: 全てdeleteして、新しくinsert


        return response()->success();
    }

    // TODO: Serviceに書き換える
    private function isEditable($userId)
    {
        return false;
    }
}
