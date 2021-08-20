<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    /**
     * 全てのタスクを取得
     * 
     * @return collection
     */
    public function getAll()
    {
        return Task::with(['category.parentCategory', 'level'])
                    ->orderBy('id')
                    ->get();
    }

    /**
     * タスクIDが有効かどうかチェック
     * 
     * @param integer[] $taskIds - あるかどうかを確認するタスクID
     * @return boolean - true if all ids exist
     */
    public function existAll($taskIds = [])
    {
        return Task::whereIn('id', $taskIds)->count() === count($taskIds); 
    }
}