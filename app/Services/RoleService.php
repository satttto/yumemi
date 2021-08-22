<?php

namespace App\Services;
use App\Models\Role;

class RoleService
{
    /**
     * Roleが有効かどうかチェック
     * 
     * @param integer $id - 確認するrole id
     * @return boolean - true if it exists
     */
    public function isIdValid($id)
    {
        return Role::where('id', $id)->exists();
    }
    
}