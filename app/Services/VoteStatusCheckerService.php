<?php

namespace App\Services;

use App\Models\Vote;

class VoteStatusCheckerService
{
    public function isVotable($userId)
    {
        return !Vote::where('user_id', $userId)->exists();
    }

    public function isEditable()
    {
        return $this->isVotable();
    }
}