@extends('layouts.main')

@section('content')
    <h1>Create TODO list</h1>
    <form action="/todos" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                
                    <label class="label font-weight-bold" for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title for the list" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>  
        </div> 
        <!-- add task  -->
        <div id="tasks">
           @if (!is_null(old('tasks')))
                <?php $i = 0; ?>
                @foreach (old('tasks') as $task)
                    <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="label font-weight-bold" for="task-description">Task description</label>
                                    <input type="text" class="form-control" id="task-description" name="tasks[{{ $i }}][description]" placeholder="Enter task description" value="{{ $task['description'] }}" required>
                                    @error('tasks.' . $i . '.description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group date" data-provide="datepicker">
                                    <label class="label font-weight-bold" for="task-deadline">Deadline</label>
                                    <input type="text" class="form-control datepicker" name="tasks[{{ $i }}][deadline]" id="datepicker{{ $i }}" autocomplete="off" value="{{ $task['deadline'] }}">
                                    @error('tasks.' . $i . '.deadline')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <input type="hidden" name="tasks[{{ $i }}][disabled]" value="0" />
                                        <input type="checkbox" class="form-check-input" id="disabled" name="tasks[{{ $i }}][disabled]"  {{ $task['disabled'] ? 'checked' : '' }} value="1">
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
        <div class="btn btn-secondary mt-2 mb-2" onclick="addTask()">Add Task</div>
        @error('tasks')
            <p class="text-danger"> {{ $message }}</p>
        @enderror

        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary btn-lg">Create list</button>
        </div>
        
    </form>       

@endsection