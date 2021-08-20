<?php

namespace App\Services;
use Illuminate\Database\QueryException;
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
     * @return boolean - true if succeeded to create
     */
    public function register($name, $email, $password, $roleId)
    {
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'role_id' => $roleId,
            ]);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Emailがユニークかどうかチェック
     * 
     * @param string $email - ユニークかどうか確認するemail
     */
    public function isUniqueEmail($email)
    {
        return !User::where('email', $email)->exists();
    }
    
}