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
     * Login
     */
    public function login(Request $request) 
    {
        
        // Validating input
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            // return 422
            return response()->error('validation error', Status::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        // Find the user
        if (Auth::attempt($credentials)) {
            return response()->success('login succeeded');
        }

        // It doesn't match any user, return 400
        return response()->error('Did not match any user');
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return response()->success('logout succeeded');
    }
}
