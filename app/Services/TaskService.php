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
                    ->orderBy('sort_number')
                    ->get();
        $tasks = $this->dropColumns($tasks);
        return $tasks;
    }

    /**
     * level_id, category_id, category.parent_category_idの列を削除
     */
    private function dropColumns($tasks)
    {
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