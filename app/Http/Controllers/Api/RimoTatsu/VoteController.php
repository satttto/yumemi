<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Services\VoteService;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as Status; // see details see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798



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
    public function vote(Request $request)
    {
        //TODO: Auth::user()->id
        $userId = 1;

        // TODO: answerのバリデーション
        try {
            $request->validate([
                'answer' => 'required|integer|min:1'
            ]);
        } catch (ValidationException $e) {
            return response()->error('validation error', Status::HTTP_UNPROCESSABLE_ENTITY);
        }

        // ユーザーが投票可能かどうかの判定
        try {
            if (!$this->voteService->isVotable($userId)) {
                return response()->success('Not votable');
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
}
