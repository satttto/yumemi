<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Services\VotabilityCheckerService;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    private $checker;

    public function __construct(VotabilityCheckerService $checker)
    {
        $this->checker = $checker;
    }

    public function VoteStatus(Request $request)
    {
        // TODO: Auth::user()->id
        $userId = 2;

        return response()->success('success', [
            'is_votable' => $this->checker->isVotable($userId),
        ]);
    }
}
