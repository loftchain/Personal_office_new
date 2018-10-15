@extends('layouts.app')

@section('content')
    <div class="login modalFrame">
        <div class="modalFrame__title">Welcome Back</div>
        <div class="modalFrame__subtitle">enter your account to view your orders</div>
        <form class="loginForm icoForm" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="formControl">
                <label class="icoForm__label">E-mail</label>
                <input class="icoForm__input" type="email" name="email" required>
            </div>
            <div class="error-message error-message0 email not_confirmed failed"></div>
            <div class="formControl">
                <label class="icoForm__label">Password</label>
                <input class="icoForm__input" type="password" name="password" required>
                <div class="icoForm__linkContainer text-right"><a class="link" href="{{ route('password.request') }}">Forgot your password?</a></div>
            </div>
            <div class="error-message error-message1 password pwd_not_match"></div>
            <div class="formControl">
                <button class="btn" name="submit">Sign in</button>
            </div>
        </form>
        <div class="textSeparator">or</div>
        <div class="row">
            <div class="col-md-6"><a class="btnSecondary btnSecondary--googleLogin" href="{{ route('social.redirect', 'google') }}">Sign in with Gmail</a>
            </div>
            <div class="col-md-6"><a class="btnSecondary btnSecondary--facebookLogin" href="{{ route('social.redirect', 'facebook') }}">Sign in with Facebook</a>
            </div>
        </div>
        <div class="formRegText">Do not have account?&nbsp;<a class="link" href="{{ route('register') }}">Register</a></div>
    </div>

{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Login') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('login') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="form-check">--}}
                                    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{--<label class="form-check-label" for="remember">--}}
                                        {{--{{ __('Remember Me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-8 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Login') }}--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--{{ __('Forgot Your Password?') }}--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
