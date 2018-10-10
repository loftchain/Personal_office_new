<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#FFD703">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.links')
</head>
<body>
<div id="app">
    <div class="gradientLeft"></div>
    <div class="gradientBottom"></div>
    <div class="gradientRight"></div>

    @auth
        <div class="container">
            <div class="forSlideMenu">
                <div class="cabinetHolder">
                    <div class="sidebar jsSidebar">
                        <div class="userInfo">
                            <div class="userInfo__avatar"><a class="userInfo__avatarLink" href="#"><img
                                            class="userInfo__avatarImage" src="{{ asset('img/avatar.jpg') }}" alt="Name Surname"></a>
                            </div>
                            <div class="userInfo__text">
                                <div class="userInfo__textItem">{{ Auth::user()->name }}</div>
                                <div class="userInfo__textItem">Status: Not verified</div>
                                <div class="userInfo__textItem">Token amount: 876 LSD</div>
                            </div>
                        </div>
                        <div class="mainMenu">
                            <ul class="mainMenu__list">
                                <li class="mainMenu__item mainMenu__item--active"><a class="mainMenu__link" href="{{ route('home.index') }}">ICO</a>
                                </li>
                                <li class="mainMenu__item"><a class="mainMenu__link"
                                                                                     href="{{ route('home.kyc') }}">Verification</a>
                                </li>
                                <li class="mainMenu__item"><a class="mainMenu__link" href="cabinetBuyTokens.html">Buy
                                        tokens</a></li>
                                <li class="mainMenu__item"><a class="mainMenu__link" href="cabinetReferral.html">Referral
                                        Program</a></li>
                                <li class="mainMenu__item"><a class="mainMenu__link" href="{{ route('home.settings') }}">Settings</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endauth

                    {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">--}}
                    {{--<div class="container">--}}
                    {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                    {{--{{ config('app.name', 'Laravel') }}--}}
                    {{--</a>--}}
                    {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                    {{--</button>--}}

                    {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav mr-auto">--}}

                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav ml-auto">--}}
                    {{--<!-- Authentication Links -->--}}
                    {{--@guest--}}
                    {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                    {{--@if (Route::has('register'))--}}
                    {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                    {{--@endif--}}
                    {{--</li>--}}
                    {{--@else--}}
                    {{--<li class="nav-item dropdown">--}}
                    {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                    {{--</a>--}}

                    {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                    {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                    {{--onclick="event.preventDefault();--}}
                    {{--document.getElementById('logout-form').submit();">--}}
                    {{--{{ __('Logout') }}--}}
                    {{--</a>--}}

                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                    {{--@csrf--}}
                    {{--</form>--}}
                    {{--</div>--}}
                    {{--</li>--}}
                    {{--@endguest--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</nav>--}}

                    {{--<main class="py-4">--}}
                    @yield('content')
                    {{--</main>--}}
                    @auth
                </div>
            </div>
        </div>
    @endauth
</div>
@include('layouts.scripts')
</body>
</html>
