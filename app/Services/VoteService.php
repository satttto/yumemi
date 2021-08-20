<?php

namespace App\Services;
use App\Models\Achievement;
use App\Models\Vote;

class VoteService
{
    /**
     * 宝くじ参加
     * 
     * @param integer $userId - 参加するユーザーのID
     * @param integer $answer - ユーザーの回答
     * @return boolean - true if succeeded to join
     */
    public function vote($userId, $answer) 
    {
        try {
            Vote::create([
                'user_id' => $userId,
                'answer' => $request->answer,
            ]);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }


    /**
     * ユーザーが宝くじ参加可能かチェック
     * 
     * @param integer $userId - 参加可能かを確認するユーザーのID
     * @return boolean - true if  
     *      1. user id doesn't exist in votes table AND 
     *      2. more than 15 achievements
     */
    public function isVotable($userId)
    {
        if (Vote::where('user_id', $userId)->exists() ||
            Achievement::where('user_id', $userId)->count() < 15) {
            return false;
        }
        return true;
    }

    /**
     * ユーザーの達成リストを変更可能かのチェック
     * 
     * @param integer $userId - 変更可能かを確認するユーザーのID
     * @return boolean - true if user id doesn't exist in votes tables
     */
    public function isEditable($userId)
    {
        return !Vote::where('user_id', $userId)->exists();
    }
}