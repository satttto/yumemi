<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    /**
     * Check if all the task ids are in tasks table
     */
    public function existAll($taskIds = [])
    {
        return Task::whereIn('id', $taskIds)->count() === count($taskIds); 
    }
}