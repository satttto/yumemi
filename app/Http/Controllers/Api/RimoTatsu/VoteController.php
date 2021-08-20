<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Services\VoteStatusCheckerService;
use Illuminate\Http\Request;
/** 
 * status code
 * see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
 */
use \Symfony\Component\HttpFoundation\Response as Status;
use App\Models\Vote;

class VoteController extends Controller
{
    private $checker;

    public function __construct(VoteStatusCheckerService $checker)
    {
        $this->checker = $checker;
    }

    /**
     * Votablity checker
     */
    public function voteStatus(Request $request)
    {
        //TODO: Auth::user()->id
        $userId = 3;
        return response()->success('success', [
            'is_votable' => $this->checker->isVotable($userId),
        ]);
    }


    /**
     * Vote
     */
    public function vote(Request $request)
    {
        //TODO: Auth::user()->id
        $userId = 1;

        // Check if the user already takes part in, return error(400)
        if (!$this->checker->isVotable($userId))
        {
            return response()->error('Not votable', Status::HTTP_BAD_REQUEST);
        }

        // Insert data
        try {
            Vote::create([
                'user_id' => $userId,
                'answer' => $request->answer,
            ]);
            return response()->success('success');
        } catch (QueryException $e) {
            return response()->error('failed to create', Status::HTTP_CONFLICT);
        }
    }
}
