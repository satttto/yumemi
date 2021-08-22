<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/** 
 * status code
 * see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
 */
use \Symfony\Component\HttpFoundation\Response as Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * ログイン
     */
    public function login(Request $request) 
    {
        
        // Validating input
        // TODO: 別な場所に切り出す
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->error('validation error', Status::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        // ユーザーのログイン
        if (Auth::attempt($credentials)) {
            return response()->success('login succeeded');
        }

        return response()->error('Did not match any user');
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
