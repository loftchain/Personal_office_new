@extends('layouts.app')

@section('content')
    <div class="login modalFrame">
        @if(session('messages'))
            <div class="alert alert-danger" role="alert">
                {{ session('messages') }}
            </div>
        @endif
        <div class="modalFrame__title">Welcome Back</div>
        {{--<div class="modalFrame__subtitle">{!! trans('modals/modals.enter') !!}</div>--}}
        <form class="loginForm icoForm" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.enterYourEmail_label') !!}</label>
                <input class="icoForm__input" type="email" name="email" required value="user@demo.io">
            </div>
            <div class="error-message error-message0 email not_confirmed failed"></div>
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.уourPassword_label') !!}</label>
                <input class="icoForm__input" type="password" name="password" required value="Password123!">
                <div class="icoForm__linkContainer text-right"><a class="link" href="{{ route('password.request') }}">{!! trans('home/welcome.forgotPwd_a') !!}</a></div>
            </div>
            <div class="error-message error-message1 password pwd_not_match"></div>
            <div class="formControl">
                <button class="btn" name="submit">{!! trans('modals/modals.signIn_btn') !!}</button>
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
        </form>
        <div class="textSeparator">{!! trans('modals/modals.or') !!}</div>
        <div class="row">
            <div class="col-md-6"><a class="btnSecondary btnSecondary--googleLogin" href="{{ route('social.redirect', 'google') }}">{!! trans('modals/modals.signIn_google') !!}</a>
            </div>
            <div class="col-md-6"><a class="btnSecondary btnSecondary--facebookLogin" href="{{ route('social.redirect', 'facebook') }}">{!! trans('modals/modals.signIn_facebook') !!}</a>
            </div>
        </div>
        <div class="formRegText">{!! trans('modals/modals.not_have_account') !!} <a class="link" href="{{ route('register') }}">{!! trans('modals/modals.signUp_title') !!}</a></div>
    </div>
@endsection
