@extends('layouts.main')

@section('content')
    <h1>TODO Lists</h1>
    @if (isset($todoLists))
        @php
            $i = 0;
        @endphp
        @foreach ($todoLists as $todo)
            @if ($i % 3 == 0)
                <div class="row">
            @endif
            <div class="col-sm-4">
                <div class="card {{ $todo->completed ? 'border-success' : 'border-warning' }}" style="width: 18rem;  margin-bottom: 10px;">
                    <div class="card-body">
                        <a href="{{ $todo->path() }}"><h5 class="card-title text-center">{{ $todo->title }}</h5></a>
                        <div class="text center">
                            @if ($todo->completed)
                                <p class="text-success font-weight-bold">List completed</p>
                            @else 
                                <p class="text-warning font-weight-bold">List not completed</p>
                            @endif
                        </div>
                        <div class="text-center mb-2">
                            <canvas id="pieChart{{ $i }}" class="todo-chart"></canvas>
                        </div>
                        <div class="d-flex justify-content-center flex-wrap"> 
                            <a href="{{ $todo->pathEdit() }}" class="btn btn-secondary btn-md m-1">Edit</a>
                            <a href="{{ $todo->path() }}" class="btn btn-secondary btn-md m-1">View</a>
                        </div>           
                    </div>   
                </div>
            </div>
            @if ($i % 3 == 2)
                </div>
            @endif
            @php
                $i++;  
            @endphp
        @endforeach
    @endif  
    <div>
        <a href="/todos/create" class="btn btn-primary">Add New</a>
    </div>  
@endsection