<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{route('authors')}}">
                    Authors
                    </a>

                    <a class="navbar-item" href="{{route('books')}}">
                    Books
                    </a>

                    <a class="navbar-item" href="{{route('tags')}}">
                    Tags
                    </a>
                </div>
                @guest
                    @if (Route::has('register'))
                    <div class="navbar-end">
                      <div class="navbar-item">
                        <div class="buttons">
                          <a class="button is-primary" href="{{ route('login') }}">
                            <strong>{{ __('Login') }}</strong>
                          </a>
                          <a class="button is-light" href="{{ route('register') }}">
                            {{ __('Register') }}
                          </a>
                        </div>
                      </div>
                    </div>
                    @endif
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                          {{ Auth::user()->first_name }}
                        </a>
                        <div class="navbar-dropdown">
                          <a class="navbar-item">
                            Manage
                          </a>
                          <hr class="navbar-divider">
                          <a class="navbar-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                          </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </nav>
        <div class="container">
          <div class="notification">
            @yield('content')
          </div>
        </div>
    </div>
<div id = "wrapper"></div>
    <footer class="footer" >
  <div class="content has-text-centered">
    <p>
      <strong>Made</strong> by <a href="https://github.com/">Nedelcescu Radu Costin</a>. The source code is licensed
      <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. 
    </p>
  </div>
</footer>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
