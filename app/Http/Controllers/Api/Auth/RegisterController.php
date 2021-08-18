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
        // Validation 
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Create a record
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);
            return response()->json($user, 200);
        } catch (QueryException $e) {
            if ($e->getCode === 23000) {
                return response()->json(['messsage' => 'duplicate user'], 422);
            } 
            // TODO: 考えられるエラーを列挙して、エラーコードごとに対処する
            return response()->json(['messsage' => $e->getMessage()], 422);
        }
    }
}
