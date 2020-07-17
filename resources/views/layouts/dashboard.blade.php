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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">
    <div id="app" class="row">
        <aside class="col-md-2 bg-dark">
            <div class="aside-dev bg-light shadow">
            <div class="row align-items-center aside-avatar">
                <div class="col-md-12 text-center">
                    <img class="avatar-img" src="{{ asset('img/head.jpg') }}" width="80" height="80"/>
                </div>
                <div class="col-md-12 text-center">
                    <span>Kelvin</span>
                </div>
            </div>
            <hr/>
            <div class="container text-center">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <span style="font-size: 1.0em;">
                                <i class="fa fa-television"></i>
                            </span>
                            &nbsp;{{ __('messages.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/article/show') }}">
                            <span style="font-size: 1.0em;">
                                <i class="fa fa-book"></i>
                            </span>
                            &nbsp;{{ __('messages.article') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span style="font-size: 1.0em;">
                                <i class="fa fa-tags"></i>
                            </span>
                            &nbsp;{{ __('messages.tag') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#">
                            <span style="font-size: 1.0em;">
                                <i class="fa fa-th-large"></i>
                            </span>
                            &nbsp;{{ __('messages.category') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#">
                            <span style="font-size: 1.0em;">
                                <i class="fa fa-user"></i>
                            </span>
                            &nbsp;{{ __('messages.user') }}
                        </a>
                    </li>
                </ul>
            </div>
            </div>
        </aside>

        <div class="col-md-10">
            <header class="dash-header">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ url('/dashboard') }}">
                            <img src="{{ asset('img/hero_black.png') }}" width="83" height="30" alt="" loading="lazy">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="javascirpt:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <language langs="{{ __('messages.locale') }},{{ __('messages.zh') }},{{ __('messages.en') }},{{ __('messages.ja') }}"/>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                @yield('content')
            </main>            
        </main>
        <footer>   
            <div class="fixed-bottom row justify-content-center align-items-center bg-light footer-text">
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
    </div>
</body>
</html>
