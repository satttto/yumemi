<?php

namespace App\Services;

use App\Models\Vote;

class VotabilityCheckerService
{
    public function isVotable($userId)
    {
        return true;
    }
}