<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use \Symfony\Component\HttpFoundation\Response as Status; // see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * ログイン
     */
    public function login(LoginRequest $request) 
    {
        // 認証に必要な情報の取得
        $credentials = ['email' => $request->email, 'password' => $request->password];

        // ユーザーのログイン
        if (Auth::attempt($credentials)) {
            return response()->success('login succeeded');
        }

        return response()->error('Email and/or Password is wrong', Status::HTTP_BAD_REQUEST);
    }

    /**
     * ログアウト
     */
    public function logout()
    {
        Auth::logout();
        return response()->success('logout succeeded');
    }
}
