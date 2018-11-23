@extends('layouts.app')

@section('content')
    <div class="welcome__header">
        @include('modals.lang_selector')
    </div>
    <section class="welcome">
        <ul class="welcome__demo-list">
            <li class="welcome__demo-item">
                <span class="welcome__demo-start">Welcome</span> to demo of your future personal office</li>
            <li class="welcome__demo-item">
                <span class="welcome__demo-start">To</span> enter as a user, press login button (all the data is already kindly inserted in text inputs)</li>
            <li class="welcome__demo-item">
                <span class="welcome__demo-start">To</span> enter as an admin, change email to <span class="welcome__demo-underlined">admin@demo.io</span> (if something went wrong with the password field, please refresh the page)</li>
            <li class="welcome__demo-item">
                <span class="welcome__demo-start">Thank</span> you for choosing <a href="https://loftchain.io/" target="_blank">loftchain.io</a></li>
        </ul>
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
