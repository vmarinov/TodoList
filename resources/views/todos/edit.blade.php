@extends('layouts.main')

@section('content')
    <h1>Edit TODO list</h1>
    <form action="{{ $todo->pathUpdate() }}" method="POST" id="updateForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                
                    <label class="label font-weight-bold" for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title for the list" value="{{ $todo->title }}" required>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                </div>
            </div>  
        </div> 
        <!-- add task  -->
        <div id="tasks">
           @if (!is_null($todo->tasks))
                <?php $i = 0; ?>
                @foreach ($todo->tasks as $task)
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="hidden" name="tasks[{{ $i }}][id]" value="{{ $task->id }}">
                                <label class="label font-weight-bold" for="task-description">Task description</label>
                                <input type="text" class="form-control" id="task-description" name="tasks[{{ $i }}][description]" placeholder="Enter task description" value="{{ $task->description }}" required>
                                @error('tasks.' . $i . '.description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group date" data-provide="datepicker">
                                <label class="label font-weight-bold" for="task-deadline">Deadline</label>
                                <input type="text" class="form-control datepicker" name="tasks[{{ $i }}][deadline]" id="datepicker{{ $i }}" autocomplete="off" value="{{ $task->deadline }}">
                                @error('tasks.' . $i . '.deadline')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check-inline">
                                    <input type="hidden" name="tasks[{{ $i }}][disabled]" value="0" />
                                    <input type="checkbox" class="form-check-input" id="disabled" name="tasks[{{ $i }}][disabled]"  {{ $task->disabled ? 'checked' : '' }} value="1">
                                    <label class="form-check-label" for="disabled">Disabled</label>
                                    @error('tasks.' . $i . '.disabled')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
               @endforeach
           @endif
        </div>
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary btn-lg" form="updateForm">Update List</button>
        </div>
    </form>   
    <form action="/todos/{{ $todo->id }}" method="POST" id="delForm">
        @csrf
        @method('DELETE')
        <!--<button type="submit" form="delForm" class="btn btn-danger btn-lg">Delete List</button> -->
        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#confirmModal">
            Delete List
        </button>
        
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this list?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="delForm">Delete</button>
                </div>
            </div>
            </div>
        </div>
    </form>    

@endsection