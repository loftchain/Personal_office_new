@extends('layouts.app')

@section('content')
    <div class="gradientLeft"></div>
    <div class="gradientBottom"></div>
    <div class="gradientRight"></div>
    <div class="login modalFrame">
        <div class="modalFrame__title">Password recovery</div>
        <form class="loginForm icoForm" action="{{ route('password.request') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="formControl">
                <label class="icoForm__label">E-mail</label>
                <input class="icoForm__input" type="email" name="email" value="{{ Session::get('reset_password_email') }}" required>
            </div>
            <div class="error-message email"></div>
            <div class="formControl">
                <label class="icoForm__label">Password</label>
                <input class="icoForm__input" type="password" name="password" required>
            </div>
            <div class="error-message password"></div>
            <div class="formControl">
                <label class="icoForm__label">Repeat password</label>
                <input class="icoForm__input" type="password" name="password_confirmation" required>
            </div>
            <div class="error-message password_confirmation"></div>
@captcha
            {{--<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>--}}

            <div class="formControl">
                <button class="btn" type="submit">Set new password</button>
            </div>
        </form>
    </div>
@endsection
