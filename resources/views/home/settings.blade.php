@extends('layouts.app')

@section('content')
            <div class="workArea jsWorkArea">
                <div class="mobileMenuBtn">
                    <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
                </div>
                    <div class="messageTop">
                        <p class="messageTop__text"></p>
                    </div>
                <div class="scrollHolder">
                    <div class="content">
                        <div class="blockHolder">
                            <div class="raisedContainer raisedContainer--full basicBlock--settings">
                                @if(Auth::user()->email == null)
                                    <div class="alert alert-danger" role="alert">
                                        {!! trans('layouts/message.messageNoEmail') !!}
                                    </div>
                                @endif
                                <div class="basicBlock basicBlock--single settings">
                                    <div class="basicBlock__content">
                                        <div class="basicBlock__title text-left">{!! trans('home/settings.title') !!}</div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                {{--avatar upload form--}}
                                                @include('home.settings.avatar')
                                            </div>
                                            <div class="col-md-4">
                                                <form class="icoForm icoForm--noMargin" action="#">
                                                    <div class="formControl formControl--noMargin">
                                                        <label class="icoForm__label">{!! trans('home/settings.name') !!}</label>
                                                        <input class="icoForm__input" type="text" name="name" disabled value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">{!! trans('home/settings.email') !!}</label>
                                                        <input class="icoForm__input" type="text" name="email" disabled value="{{ Auth::user()->email }}">
                                                    </div>
                                                </form>
                                                <div class="settingsActions">
                                                    <a class="settingsActions__link jsChangeEmail" href="#">{!! trans('home/settings.changeEmail') !!}</a>
                                                    <a class="settingsActions__link jsChangePassword" href="#">{!! trans('home/settings.changePassword') !!}</a>
                                                    <div class="settingsActions__langSelector">
                                                        <div class="dropdown">
                                                            <button class="dropbtn settings__button-language">Languages</button>
                                                            <div class="dropdown-content">
                                                                <a href="{{ route('lang.switch', 'en') }}">English</a>
                                                                <a href="{{ route('lang.switch', 'ru') }}">Russian</a>
                                                                <a href="{{ route('lang.switch', 'cn') }}">Mandarin(Chinise)</a>
                                                                <a href="{{ route('lang.switch', 'es') }}">Spanish</a>
                                                                <a href="{{ route('lang.switch', 'jp') }}">Japanese</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                {{--password change form--}}
                                                @include('home.settings.form_password')

                                                {{--mail change form--}}
                                                @include('home.settings.form_email')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                @include('_js.js_img_upload')
            @endpush
@endsection
