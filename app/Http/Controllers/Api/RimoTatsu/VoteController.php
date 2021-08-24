<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoteRequest;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as Status; // see details see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use Illuminate\Database\QueryException;
use App\Services\VoteService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Auth;


class VoteController extends Controller
{
    private $voteService;
    private $roleService;

    public function __construct(VoteService $voteService, RoleService $roleService)
    {
        $this->voteService = $voteService;
        $this->roleService = $roleService;
    }

    /**
     * ユーザーが宝くじに参加できるかどうかを確認
     */
    public function voteStatus(Request $request)
    {
        $userId = Auth::id();
     
        try {
            return response()->success('success', [
                'is_votable' => $this->voteService->isVotable($userId),
            ]);
        } catch(QueryException $e) {
            return response()->error('DB error', Status::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * 宝くじに参加する
     */
    public function vote(VoteRequest $request)
    {
        $userId = Auth::id();

        // ユーザーが投票可能かどうかの判定
        try {
            if (!$this->voteService->isVotable($userId)) {
                return response()->error('Not votable', Status::HTTP_BAD_REQUEST);
            }
        } catch (QueryException $e) {
            return response()->error('DB error', Status::HTTP_INTERNAL_SERVER_ERROR);
        }

        // 投票
        try {
            $this->voteService->vote($userId, $request->answer);
            return response()->success('success');
        } catch(QueryException $e) {
            return response()->error('DB error', Status::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * 宝くじの勝者を取得する
     */
    public function getWinner(Request $request)
    {
        // 管理者であるかどうか確認する(Noの場合はエラー)
        try {
            if (!$this->roleService->isAdmin(Auth::user()->role_id)) {
                return response()->error('No permission', Status::HTTP_BAD_REQUEST);
            }
        } catch(QueryException $e) {
            return response()->error('DB error', Status::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        // 優勝者の取得
        try {
            [$winner, $answer] = $this->voteService->getWinner();
            return response()->success('success', ['user' =>  $winner, 'answer' => $answer]);
        } catch(QueryException $e) {
            return response()->error('DB error', Status::HTTP_INTERNAL_SERVER_ERROR);
        };
    }
}
