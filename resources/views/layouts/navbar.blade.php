<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item @if(Request::route()->getName() == 'home') active @endif">
            <a class="nav-link" href="{{ route('home') }}">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item @if(Request::route()->getName() == 'submissionCreate') active @endif">
            <a class="nav-link" href="{{ route('submissionCreate') }}">Give it a go!<span class="sr-only">(current)</span></a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <label>
                Search:
                <input class="form-control mr-sm-2" type="date" placeholder="Search a birthday!" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </label>
        </form>
    </div>
</nav>