<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TodoTasksController extends Controller
{
    //
    public function update(Task $task)
    {
       
        $method = request()->has('completed') ? 'complete' : 'incomplete';

        $task->$method();

        if($task->todo->canComplete()) 
        {
            $task->todo->complete();
        } else {
            $task->todo->incomplete();
        }

        return back();
    }
    
}
