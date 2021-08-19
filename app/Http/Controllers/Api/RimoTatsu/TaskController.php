<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Tasks list
     */
    public function index(Request $request) 
    {
        $tasks = Task::with(['category.parentCategory', 'level'])
                    ->orderBy('id')
                    ->get();
                    
        return response()->success('success', ["tasks" => $tasks]);
    }

}
