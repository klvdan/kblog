<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('messages.home_title') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/blueimp-md5/2.16.0/js/md5.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/hero_black.png') }}" width="83" height="30" alt="" loading="lazy">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <span style="font-size: 1.0em;">
                                    <i class="fa fa-home fa-lg"></i>
                                </span>
                                &nbsp;{{ __('messages.home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span style="font-size: 1.0em;">
                                    <i class="fa fa-th-large fa-lg"></i>
                                </span>
                                &nbsp;{{ __('messages.category') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span style="font-size: 1.0em;">
                                    <i class="fa fa-tags fa-lg"></i>
                                </span>
                                &nbsp;{{ __('messages.tag') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span style="font-size: 1.0em;">
                                    <i class="fa fa-th-list fa-lg"></i>
                                </span>
                                &nbsp;{{ __('messages.timeline') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span style="font-size: 1.0em;">
                                    <i class="fa fa-exclamation-circle fa-lg"></i>
                                </span>
                                &nbsp;{{ __('messages.about') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
                        </li>
                        <language langs="{{ __('messages.locale') }},{{ __('messages.zh') }},{{ __('messages.en') }},{{ __('messages.ja') }}"/>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer>   
        <div class="fixed-bottom row justify-content-center align-items-center bg-white footer-text">
            <span style="font-size: 1.0em;">
                <i class="fa fa-shield"></i>
            </span>
            &nbsp;鄂ICP备20012934号&nbsp;&nbsp;
            <span style="font-size: 1.0em;">
                <i class="fa fa-copyright"></i>
            </span>
            &nbsp;2020 - 2020 Kelvin
        </div>
    </footer>
    <div>
        @yield('scripts')
    </div>
</body>
</html>
