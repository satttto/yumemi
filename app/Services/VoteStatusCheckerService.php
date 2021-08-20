<?php

namespace App\Services;
use App\Models\Achievement;
use App\Models\Vote;

class VoteStatusCheckerService
{
    public function isVotable($userId)
    {
        // more than 15 achievements
        if (Vote::where('user_id', $userId)->exists() ||
            Achievement::where('user_id', $userId)->count() < 15) {
            return false;
        }
        return true;
    }

    public function isEditable($userId)
    {
        return !Vote::where('user_id', $userId)->exists();
    }
}