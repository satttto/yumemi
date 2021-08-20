<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Services\VoteService;
use Illuminate\Http\Request;
/** 
 * status code
 * see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
 */
use \Symfony\Component\HttpFoundation\Response as Status;


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
        $userId = 3;
        return response()->success('success', [
            'is_votable' => $this->voteService->isVotable($userId),
        ]);
    }


    /**
     * 宝くじに参加する
     */
    public function vote(Request $request)
    {
        //TODO: Auth::user()->id
        $userId = 1;

        // ユーザーが投票可能かどうかの判定
        if (!$this->checker->isVotable($userId)) {
            return response()->error('Not votable', Status::HTTP_BAD_REQUEST);
        }

        // 投票
        $isSuccessful = $this->voteService->vote($userId, $request->answer);
        return $isSuccessful ? response()->success('success') :
                               response()->error('failed to create', Status::HTTP_CONFLICT);
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
