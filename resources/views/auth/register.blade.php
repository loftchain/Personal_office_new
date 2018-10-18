@extends('layouts.app')

@section('content')
    <div class="login modalFrame">
        <div class="modalFrame__title">Sign up</div>
        <form class="loginForm icoForm" id="demo-form" action="{{ route('register') }}" method="post">
            {{ csrf_field() }}
            <div class="formControl">
                <label class="icoForm__label">Your name</label>
                <input class="icoForm__input" type="text" name="name" required>
            </div>
            <div class="formControl">
                <label class="icoForm__label">E-mail</label>
                <input class="icoForm__input" type="email" name="email" required>
            </div>
            <div class="error-message error-message0 email already_exists"></div>
            <div class="formControl">
                <label class="icoForm__label">Password</label>
                <input class="icoForm__input" type="password" name="password" required>
            </div>
            <div class="formControl">
                <label class="icoForm__label">Repeat password</label>
                <input class="icoForm__input" type="password" name="password_confirmation" required>
            </div>
            <div class="error-message error-message1 password"></div>

            {{--@captcha--}}
            <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
            <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
            <div class="formControl">
                <button class="btn" type="submit">Sign in</button>
            </div>
        </form>
        <div class="formRegText">Have an account?&nbsp;<a class="link" href="{{ route('login') }}">Login</a></div>
    </div>
@endsection
