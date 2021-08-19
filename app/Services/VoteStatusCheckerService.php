<?php

namespace App\Services;

use App\Models\Vote;

class VoteStatusCheckerService
{
    public function isVotable()
    {
        // TODO: Auth::user()->id
        $userId = 1;

        return !Vote::where('user_id', $userId)->exists();
    }
}