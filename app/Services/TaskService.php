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
        $tasks = Task::with(['level', 'category.parentCategory'])
                    ->orderBy('id')
                    ->get();
        $tasks->makeHidden(['level_id', 'category_id']);
        foreach($tasks as $task) {
            $task->category->makeHidden('parent_category_id');
        };
        return $tasks;
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