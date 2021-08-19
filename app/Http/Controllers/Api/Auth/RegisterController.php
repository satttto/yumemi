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
            // input validation error (422)
            return response()->error('validation error', Status::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create a record
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);
            return response()->success('registration succeeded');
        } catch (QueryException $e) {
            // Duplicate-user error (409)
            if ($e->getCode() === '23000') {
                return response()->error('Duplicate Error', Status::HTTP_CONFLICT);
            } 
            // TODO: 考えられるエラーを列挙して、エラーコードごとに対処する (409)
            return response()->error('error', Status::HTTP_CONFLICT);
        }
    }
}
