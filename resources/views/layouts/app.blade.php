<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <!-- font awesome CDN -->
    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- scatter plot CDN --}}
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>

    <!-- (Optional) Use CSS or JS implementation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/img/fotoalbum-icon.svg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div id="laravel-logo"
                        class="logo_laravel d-flex flex-column px-4  {{Auth::check() ? 'b-right' : ''}}">
                        @if (Auth::check())
                        <img src="{{ Vite::asset('resources/img/album-photo-layout.svg') }}" alt="photos-icon"
                            class="m-auto" style="width: 80px; height: 60px;">
                        <h6 id="head-h6" class="courgette-regular">Fotoalbum-backend</h6>
                        @else
                        <h6 class="courgette-regular logo-left">Fotoalbum-backend</h6>
                        @endif
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if (!Auth::check())
                        <li class="nav-item">
                            <a class="nav-link font-large {{ request()->is('/') ? 'd-none' : '' }}
                                " href="{{url('/') }}">{{
                                __('Home')
                                }}</a>
                        </li>
                        @endif
                        @if(Auth::check())
                        <li class="nav-item {{Route::currentRouteName() == 'admin.photos.index' ? 'd-none' : ''}}">
                            <a class="nav-link font-large" href="{{ route('admin.photos.index') }}">{{ __('Photos')
                                }}</a>
                        </li>
                        <li class="nav-item {{Request::is('admin/dashboard') == '' ? 'd-none' : ''}}">
                            <a class="nav-link font-large" href="{{ route('admin.drafts.index') }}">{{ __('Drafts') }}</a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{Route::currentRouteName() == 'admin.dashboard' ? 'd-none' : ''}}"
                                    href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                                <a class="dropdown-item {{Route::currentRouteName() == 'profile.edit' ? 'd-none' : ''}}"
                                    href="{{ url('profile') }}">{{__('Profile')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

<style>
    .b-right {
        border-right: solid .5px rgba(0, 0, 0, 0.162);
    }

    h6#head-h6 {
        font-size: 15px;
    }

    .courgette-regular {
        font-family: "Courgette", cursive;
        font-weight: 400;
        font-style: normal;
    }

    main {
        min-height: calc(100vh - 100px);
    }

    .logo-left {
        padding-top: .2rem;
        font-size: 25px;

        @media screen and (max-width: 450px) {
            font-size: 20px;
            font-weight: 500;
            padding-top: .5rem;
            filter: drop-shadow(0 0 .8px rgba(0, 0, 0, 0.448));
            text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.778);
        }
       
    }
</style>

</html>