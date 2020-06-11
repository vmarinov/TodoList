<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top mb-5">
    <a class="navbar-brand" href="/">Todo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (\Request::route()->getName() === 'home') ? 'active' : ''}}">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ (\Request::route()->getName() === 'create') ? 'active' : ''}}">
                <a class="nav-link" href="/todos/create">Create List</a>
            </li>
        </ul>
    </div>
</nav>