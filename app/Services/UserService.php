<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * ユーザーの新規登録
     * 
     * @param string $name - ユーザー名
     * @param string $email - email
     * @param string $password - 暗号化前のパスワード
     * @param integer $roleId - role id
     */
    public function register($name, $email, $password, $roleId)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role_id' => $roleId,
        ]);
    }
}