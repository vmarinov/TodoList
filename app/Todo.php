<?php

namespace App;

use App\Task;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{   
    protected $fillable = ['title', 'completed'];

    public function path()
    {
        return route('todos.show', $this);
    }

    public function pathEdit()
    {
        return route('todos.edit', $this);
    }

    public function pathUpdate() {
        return route('todos.update', $this);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function complete($completed = true)
    {
        $this->update(compact('completed'));
    }

    public function incomplete()
    {
        $this->complete(false);
    }

    public function addTasks(Array $tasks)
    {
        foreach($tasks as $task) {
            $this->tasks()->create($task);
        }
    }

    public function updateTasks(Array $tasks) {
        foreach ($tasks  as $task) {
            Task::where('id', $task['id'])
            ->update(['description' => $task['description'],
                        'deadline'  => $task['deadline'],
                        'disabled'  => $task['disabled'] 
            ]);
        }
    }

    public function tasksData() {

        return [
            'active'    => $this->activeTasksCount(),
            'completed' => $this->completedTasksCount(),
            'disabled'  => $this->disabledTasksCount(),
            'expired'   => $this->expiredTasksCount()
        ];
    }

    
    public function totalTasks() {
        
        return $this->tasks()->count();
    }

    public function activeTasksCount()
    {
        return $this->tasks()->where('completed', false)->where('disabled', false)
        ->where(function($query) {
            $query->where('deadline', '>', now())
                ->orWhere('deadline', '=', null);
        })
        ->count();
    }

    public function completedTasksCount()
    {
        return $this->tasks()->where('completed', true)->count();
    }

    public function disabledTasksCount() {
        
       return $this->tasks()->where('disabled', true)->count();
    }

    public function expiredTasksCount() {

        return $this->tasks()->where('deadline', '!=', null)->where('deadline', '<', now())->count();
    }

    public function canComplete() {
        return $this->completedTasksCount() === $this->totalTasks();
    }
}
