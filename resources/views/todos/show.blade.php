@extends('layouts.main')

@section('content')
    <div>
        <h1>{{ $todo->title }}</h1>
    </div>
    <h3>Tasks</h3>
        <form action="/task/update"></form>
        @foreach ($todo->tasks as $task)
            @php
                $divClass = 'list-group-item-warning';
                if($task->completed) { 
                    $divClass = 'list-group-item-success'; 
                } 
                if($task->disabled) { 
                    $divClass = 'list-group-item-secondary'; 
                }  
                if($task->expired()) {
                    $divClass = 'list-group-item-danger';
                }
            @endphp
            <div class="list-group-item list-group-item-action {{ $divClass }}">  
                <div class="row">
                    <div class="col-sm-2">
                        <div class="font-weight-bold">{{ $task->description }}</div>  
                    </div>
                    <div class="col-sm-4">
                        <form action="/task/{{ $task->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-check-inline">
                                <input type="checkbox" class="form-check-input" id="complete" name="completed"  {{ ($task->completed) ? 'checked' : '' }} value="1" onchange="this.form.submit()">
                                <label class="form-check-label" for="complete">Complete</label>
                            </div>
                        </form>
                        
                        <input type="hidden" name="id" value="{{ $task->id }}">
                    </div>
                    <div class="col-sm-4">
                        @if (!is_null($task->deadline))
                            <div class="font-weight-bold">
                                Deadline: {{ $task->deadline }}    
                            </div>
                        @endif    
                    </div>    
                </div>              
            </div>
        @endforeach        
    </div>    
@endsection