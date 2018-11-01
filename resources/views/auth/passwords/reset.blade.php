@extends('layouts.app')

@section('content')
    <div class="gradientLeft"></div>
    <div class="gradientBottom"></div>
    <div class="gradientRight"></div>
    <div class="login modalFrame">
        <div class="modalFrame__title">{!! trans('modals/modals.resetPwd_title') !!}</div>
        <form class="loginForm icoForm" action="{{ route('password.request') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.reg_email') !!}</label>
                <input class="icoForm__input" type="email" name="email" value="{{ Session::get('reset_password_email') }}" required>
            </div>
            <div class="error-message reset_email_not_match"></div>
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.reg_password') !!}</label>
                <input class="icoForm__input" type="password" name="password" required>
            </div>
            <div class="error-message password"></div>
            <div class="formControl">
                <label class="icoForm__label">{!! trans('modals/modals.reg_repeatPassword') !!}</label>
                <input class="icoForm__input" type="password" name="password_confirmation" required>
            </div>
            <div class="error-message password"></div>

            <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
            <div class="error-message g-recaptcha-response"></div>

            <div class="formControl">
                <button class="btn" type="submit">{!! trans('modals/modals.setNewPass') !!}</button>
            </div>
        </form>
    </div>
@endsection
