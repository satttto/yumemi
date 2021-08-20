<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\RoleService;
use Illuminate\Http\Request;
/** 
 * status code
 * see https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
 */
use \Symfony\Component\HttpFoundation\Response as Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
     * ユーザーの新規登録
     */
    public function register(Request $request) 
    {
        // Validating input
        // TODO: 別な場所に切り出す
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->error('validation error', Status::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Emailがユニークかどうかチェック
        if (!$this->userService->isUniqueEmail($request->email)) {
            return response()->error('emai not unique', Status::HTTP_CONFLICT);
        }

        // 有効なroleかどうかをチェック
        if (!$this->roleService->isIdValid($request->role_id)) {
            return response()->error('invalid role id', Status::HTTP_BAD_REQUEST);
        }

        // ユーザー新規作成
        $isSuccessful = $this->userService->register(
            $request->name,
            $request->email,
            $request->password,
            $request->role_id
        );
        return $isSuccessful ? response()->success('registration succeeded') :
                               response()->error('error', Status::HTTP_CONFLICT);
    }
}
