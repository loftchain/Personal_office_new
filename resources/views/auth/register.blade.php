@extends('layouts.app')

@section('content')
    <div class="login modalFrame modalFrame--fix">
        <div class="modalFrame__title">{!! trans('modals/modals.signUp_title') !!}</div>
        <form class="loginForm icoForm" id="demo-form" action="{{ route('register') }}" method="post">
            {{ csrf_field() }}
            <div class="formControl">
                <input class="icoForm__input" type="text" name="name" placeholder="{!! trans('modals/modals.reg_yourName') !!}" required>
            </div>
            <div class="error-message error-message name already_exists"></div>
            <div class="formControl">
                <input class="icoForm__input" type="email" name="email" placeholder="{!! trans('modals/modals.reg_email') !!}" required>
            </div>
            <div class="error-message error-message0 email already_exists"></div>
            <div class="formControl">
                <input class="icoForm__input" type="password" name="password" placeholder="{!! trans('modals/modals.reg_password') !!}" required>
            </div>
            <div class="error-message error-message1 password"></div>
            <div class="formControl">
                <input class="icoForm__input" type="password" name="password_confirmation" placeholder="{!! trans('modals/modals.reg_repeatPassword') !!}" required>
            </div>
            <div class="error-message error-message2 password"></div>
            <div class="checkboxControl">
                <input class="signUpCheckbox checkbox" type="checkbox" id="terms_checkbox" name="terms_checkbox">
                <label for="terms_checkbox">{!! trans('modals/modals.have_read') !!}
                    <a target="_blank" href="https://mitoshi.io/terms_and_conditions/">{!! trans('modals/modals.terms') !!}</a> &
                    <a target="_blank" href="https://mitoshi.io/privacy_policy/">{!! trans('modals/modals.policy') !!}</a>
                    {!! trans('modals/modals.accept') !!}
                </label>
            </div>
            <div class="checkboxControl">
                <input class="signUpCheckbox checkbox" type="checkbox" id="essentials_checkbox" name="essentials_checkbox">
                <label for="essentials_checkbox">{!! trans('modals/modals.have_read_essentials') !!}</label>
            </div>
            @if(env('APP_ENV') != 'local')
                <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
            @endif
            <div class="formControl">
                <button class="btn signUpBtn" type="submit">{!! trans('modals/modals.signUp_btn') !!} </button>
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
        </form>
        <div class="formRegText">{{ trans('modals/modals.have_account') }}<a class="link" href="{{ route('login') }}">{{ trans('modals/modals.signIn_title') }}</a></div>
    </div>
@endsection
