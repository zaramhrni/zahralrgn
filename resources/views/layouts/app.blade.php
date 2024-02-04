<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #B0C4DE; height: 70px;">
            <div class="container d-flex justify-content-center">
                <!-- Logo "Zshop" -->
                <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold; color: rgb(10, 10, 10);">
                    Zshop
                </a>

                <!-- Toggler Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Items -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-3">
                        @auth
                            @if (Auth::user()->role_id === 3)
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Home' ? 'active' : '' }}" style="font-weight: bold; color: white" aria-current="page"
                                        href="{{ route('home') }}">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle" style="font-weight: bold; color: white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Saldo
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('topup') }}">Isi Saldo</a>
                                            <a class="dropdown-item" href="{{ route('tariktunai') }}">Tarik Tunai</a>
                                        </div>
                                    </div>
                                </li>
                            
                            @endif
                            @if (Auth::user()->role_id === 2)
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Menu' ? 'active' : '' }} " style="font-weight: bold; color: white"
                                        href="{{ route('menu') }}">Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Data Transaksi' ? 'active' : '' }}" style="font-weight: bold; color: white"
                                        href="{{ route('data_transaksi') }}">Data Transaksi</a>
                                </li>
                            @endif
                            @if (Auth::user()->role_id === 1)
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Transaksi Bank' ? 'active' : '' }}" style="font-weight: bold; color: white" aria-current="page"
                                        href="{{ route('transaksi_bank') }}">Transaksi Bank</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                            @endif
                            @if (Route::has('register'))
                            @endif
                        @else
                            <li class="nav-item dropdown" style="color: white">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-weight: bold; color: white" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
