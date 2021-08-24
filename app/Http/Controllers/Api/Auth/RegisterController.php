<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use \Symfony\Component\HttpFoundation\Response as Status; // see Details https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use App\Services\UserService;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 一般ユーザーの新規登録
     */
    public function register(RegisterRequest $request) 
    {
        // 一般ユーザー新規作成
        try {
            $user = $this->userService->register(
                $request->name,
                $request->email,
                $request->password,
                Role::where('type', '一般')->first()->id,
            );
        } catch (QueryException $e) {
            \Log::debug($e->getMessage());
            return response()->error('Internal server error', Status::HTTP_INTERNAL_SERVER_ERROR);
        }
        Auth::login($user);
        $request->session()->regenerate();
        return response()->success('registration succeeded');
    }
}
