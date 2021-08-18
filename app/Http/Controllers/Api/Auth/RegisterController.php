<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Register a user
     */
    public function register(Request $request) 
    {
        // Validating input
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->error('validation error', 422);
        }

        // Create a record
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);
            return response()->success($user);
        } catch (QueryException $e) {
            // Duplicate-user error
            if ($e->getCode() === '23000') {
                return response()->error('Duplicate Error', 409);
            } 
            // TODO: 考えられるエラーを列挙して、エラーコードごとに対処する
            return response()->error('error', 409);
        }
    }
}
