<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>To-do Or Not To-do</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
        <!--<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">-->

    </head>

    <body>
        @include('layouts.header')
        @include('layouts.navbar')
        <div class="content">
            <div class="container">
                @yield('content')
            </div>
        </div>
        @include('layouts.footer')
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/tasks/task.js')}}"></script>
        <script src="{{asset('js/todos/modals.js')}}"></script>
        @if(isset($tasks_data))
            <script type="text/javascript">
                var task_data = @json($tasks_data);
            </script>
            <script src="{{asset('js/todos/Chart.min.js')}}"></script>
            <script src="{{asset('js/todos/pie-chart.js')}}"></script>      
        @endif
    </body>
</html>