<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoteRequest;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as Status; // see details see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Services\VoteService;



class VoteController extends Controller
{
    private $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    /**
     * ユーザーが宝くじに参加できるかどうかを確認
     */
    public function voteStatus(Request $request)
    {
        //TODO: Auth::user()->id
        $userId = 4;
        try {
            return response()->success('succeeded to check if votable', [
                'is_votable' => $this->voteService->isVotable($userId),
            ]);
        } catch(QueryException $e) {
            return response()->error('failed to check if votable', Status::HTTP_BAD_REQUEST);
        }
    }


    /**
     * 宝くじに参加する
     */
    public function vote(VoteRequest $request)
    {
        //TODO: Auth::user()->id
        $userId = 1;

        // ユーザーが投票可能かどうかの判定
        try {
            if (!$this->voteService->isVotable($userId)) {
                return response()->error('Not Votable', Status::HTTP_BAD_REQUEST);
            }
        } catch (QueryException $e) {
            return response()->error('Bad query', Status::HTTP_BAD_REQUEST);
        }

        // 投票
        try {
            $this->voteService->vote($userId, $request->answer);
            return response()->success('succeeded to vote');
        } catch(QueryExceptkon $e) {
            return response()->error('failed to create', Status::HTTP_CONFLICT);
        }
    }

    /**
     * 宝くじの勝者を取得する
     */
    public function getWinner(Request $request)
    {
        [$winner, $answer] = $this->voteService->getWinner();
        return $winner ? response()->success('success', ['user' =>  $winner, 'answer' => $answer]) :
                               response()->error('failed to fetch');
    }
}
