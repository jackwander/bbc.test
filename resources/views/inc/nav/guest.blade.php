<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Negros Bank Checker') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a>
                </li>
                <li>
                    <a class="nav-link" href="/branches"><i class="fas fa-warehouse"></i> Branches</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/about"><i class="fas fa-info"></i> About</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i>  {{ __('Login') }}</a></li>
            </ul>
        </div>
    </div>
</nav>