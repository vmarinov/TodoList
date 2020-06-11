<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index()
    {
        //get todo lists from db

        //used for pie chart
        $tasks_data = [];
       
        $todoLists = Todo::all();

        foreach($todoLists as $list) {
            $tasks_data[] = $list->tasksData();
        }
        return view('todos.index', compact(['tasks_data', 'todoLists']));
        //return view('todos.index');
    }

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function store(Request $request)
    {
        

        $this->validateTodo();
        
        $todoList = Todo::create([
            'title' => $request->input('title')
        ]);
        
        $tasks = $request->tasks;
        $todoList->addTasks($tasks);

        return redirect('/');
    }

    public function update(Todo $todo)
    {
        $this->validateTodo();
        $todo->update(['title' => request()->title]);
        $todo->updateTasks(request()->tasks);

        return redirect($todo->path());
    }

    public function destroy(Todo $todo)
    {
        Todo::destroy($todo->id);      
        
        return redirect('/');
    }

    protected function validateTodo()
    {   
        $taskDescriptionRule = 'required|distinct|min:3|max:30|unique:tasks,description';
        $todoTitleRule = 'required|min:3|max:20|unique:todos,title';
        if(request()->input('todo_id')) {
            $taskDescriptionRule = 'required|distinct|min:3|max:30';
            $todoTitleRule = 'required|min:3|max:20';
        }
        $rules = [
            'title'                 =>  $todoTitleRule,
            'tasks'                 => 'required|array',
            'tasks.*.description'   =>  $taskDescriptionRule,
            'tasks.*.deadline'      => 'nullable|date',
            'tasks.*.disabled'      => 'boolean',
            'tasks.*.id'            => 'sometimes|integer'
        ];

        $messages = [
            'tasks.required'                => 'You need to add a task',
            'tasks.*.description.required'  => 'Task description is required field',
            'tasks.*.description.unique'    => 'There already is a task with that description',
            'tasks.*.description.distinct'  => 'You cannot have more than one task with same description',
            'tasks.*.description.min'       => 'Task description must be at least :min characters.',
            'tasks.*.description.max'       => 'Task description may not be greater than :max characters.',
            'tasks.*.deadline.date'         => 'This is not a valid date',
        ];
        
        $validator = Validator::make(request()->all(), $rules, $messages);

        return $validator->validate();
    }
}
