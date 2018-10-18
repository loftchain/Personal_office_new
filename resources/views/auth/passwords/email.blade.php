@extends('layouts.app')

@section('content')
    <div class="gradientLeft"></div>
    <div class="gradientBottom"></div>
    <div class="gradientRight"></div>
    <div class="login modalFrame">
        <div class="modalFrame__title">Forgot your password</div>
        <form class="loginForm icoForm" action="{{ route('sendResetLinkEmail') }}" method="post">
            {{ csrf_field() }}
            <div class="formControl">
                <label class="icoForm__label">E-mail</label>
                <input class="icoForm__input" type="email" name="email" required>
            </div>
            @captcha
            <div class="formControl">
                <button class="btn" type="submit">Next</button>
            </div>
        </form>
    </div>
@endsection
