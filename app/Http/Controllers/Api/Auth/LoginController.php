<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            return response()->error('validation error', 422);
        }
        
        // Find a user
        if (Auth::attempt($credentials)) {
            return response()->success(Auth::user());
        }

        // It doesn't match any user
        return response()->error('Did not match any user', 401);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return response()->success();
    }
}
