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
        <li class="nav-item">
          <a class="nav-link" href="/branches"><i class="fas fa-warehouse"></i> Branches</a>
        </li>             
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->fname.' '.Auth::user()->lname }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a href="/settings/users/{{Auth::user()->id}}" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
          <a href="/dashboard" class="dropdown-item"><i class="fas fa-chart-bar"></i> Dashboard</a>
          <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
