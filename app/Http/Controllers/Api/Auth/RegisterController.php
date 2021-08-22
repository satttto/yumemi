<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\RoleService;
use App\Models\Role;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as Status; // see Details https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    private $userService;
    private $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * 一般ユーザーの新規登録
     */
    public function register(Request $request) 
    {
        // Validating input
        // TODO: 別な場所に切り出す
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->error('validation error', Status::HTTP_UNPROCESSABLE_ENTITY);
        }

        // 一般ユーザー新規作成
        try {
            $this->userService->register(
                $request->name,
                $request->email,
                $request->password,
                Role::where('type', '一般')->first()->id,
            );
            return response()->success('registration succeeded');
        } catch (QueryException $e) {
            return response()->error('registration failed', Status::HTTP_CONFLICT);
        }
    }
}
