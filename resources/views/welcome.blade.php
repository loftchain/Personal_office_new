@extends('layouts.app')

@section('content')
    <div class="welcome__header">
        <div class="dropdown">
            <button class="dropbtn welcome__button-language">Languages</button>
            <div class="dropdown-content">
                <a href="#">English</a>
                <a href="#">Russian</a>
                <a href="#">Mandarin(Chinise)</a>
                <a href="#">Spanish</a>
                <a href="#">Japanese</a>
            </div>
        </div>
    </div>
    <section class="welcome">
        <div class="welcome__wrapper">
            <div class="welcome__item welcome__item--registration">
                <a href="{{ route('register') }}" style="font-size: 25px" class="welcome__link">{!! trans('modals/modals.signUp_title') !!}</a>
            </div>
            <div class="welcome__item">
                <a href="{{ route('login') }}" style="font-size: 25px" class="welcome__link">{!! trans('modals/modals.signIn_title') !!}</a>
                <br>
                <a href="{{ route('password.request') }}" style="font-size: 12px" class="welcome__link welcome__link--password">{!! trans('home/welcome.forgotPwd_a') !!}</a>
            </div>
        </div>
    </section>
@endsection
