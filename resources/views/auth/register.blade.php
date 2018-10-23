@extends('layouts.app')

@section('content')
    <div class="login modalFrame">
        <div class="modalFrame__title">{!! trans('modals/modals.signUp_title') !!}</div>
        <form class="loginForm icoForm" id="demo-form" action="{{ route('register') }}" method="post">
            {{ csrf_field() }}
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.reg_yourName') !!}</label>
                <input class="icoForm__input" type="text" name="name" required>
            </div>
            <div class="error-message error-message name already_exists"></div>
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.reg_email') !!}</label>
                <input class="icoForm__input" type="email" name="email" required>
            </div>
            <div class="error-message error-message0 email already_exists"></div>
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.reg_password') !!}</label>
                <input class="icoForm__input" type="password" name="password" required>
            </div>
            <div class="error-message error-message1 password"></div>
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.reg_repeatPassword') !!}</label>
                <input class="icoForm__input" type="password" name="password_confirmation" required>
            </div>
            <div class="error-message error-message2 password"></div>
            {{--@captcha--}}
            <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
            <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
            <div class="formControl">
                <button class="btn" type="submit">{!! trans('modals/modals.signUp_btn') !!}</button>
            </div>
        </form>
        <div class="formRegText">{{ trans('modals/modals.have_account') }}<a class="link" href="{{ route('login') }}">{{ trans('modals/modals.signIn_title') }}</a></div>
    </div>
@endsection
