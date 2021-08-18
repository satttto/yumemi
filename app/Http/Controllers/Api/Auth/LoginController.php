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
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Find a user
        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Welcome'], 200);
        }

        // When it doesn't match any user
        return response()->json(['message' => 'Did not match any user'], 422);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
