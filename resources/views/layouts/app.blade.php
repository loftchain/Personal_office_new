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
    @stack('links')
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
                @include('layouts.menu')
    @endauth

                    @yield('content')

    @auth
                </div>
            </div>
        </div>
    @endauth
</div>
@include('layouts.scripts')
@stack('scripts')
</body>
</html>
