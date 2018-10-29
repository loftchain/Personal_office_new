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
                    <div class="content" id="buyTokens">
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
                                                <div class="avatarSettings">
                                                    <div class="avatarSettings__imageHolder"><img class="avatarSettings__image" src="{{ Auth::user()->img ? route('settings.get.avatar', Auth::user()->img) : asset('img/avatar.png') }}">
                                                        <form id="upload" class="icoForm icoForm--noMargin" action="{{ route('home.settings.upload.avatar') }}" method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div id="drop">

                                                                <label class="avatarSettings__uploadBtn" for="avatarUpload">
                                                                    <input class="hiddenInput" type="file" id="avatarUpload" name="avatar" multiple />
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="avatarSettings__note">{!! trans('home/settings.uploadPhoto') !!}</div>
                                                </div>
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
                                                    <a class="settingsActions__link jsChangeEmail" href="#">Change e-mail</a>
                                                    <a class="settingsActions__link jsChangePassword" href="#">Change password</a>
                                                    <div class="settingsActions__langSelector">
                                                        <div class="dropdown">
                                                            <button class="dropbtn settings__button-language">Languages</button>
                                                            <div class="dropdown-content">
                                                                <a href="#">English</a>
                                                                <a href="#">Russian</a>
                                                                <a href="#">Mandarin(Chinise)</a>
                                                                <a href="#">Spanish</a>
                                                                <a href="#">Japanese</a>
                                                            </div>
                                                        </div>
                                                        {{--<a class="settingsActions__langSelectorBtn" href="{{ route('lang.switch', 'ru') }}">RU</a>--}}
                                                        {{--<span class="settingsActions__langSelectorBtn settingsActions__langSelectorBtn--active">ENG</span>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <form class="icoForm changePassword icoForm--noMargin hidden" action="{{ route('password.change') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="formControl formControl--noMargin">
                                                        <label class="icoForm__label">{!! trans('home/settings.formPasswordOld') !!}</label>
                                                        <input class="icoForm__input" type="password" name="old_password" placeholder="{!! trans('home/settings.formPassPlaceOld') !!}">
                                                    </div>
                                                    <div class="error-message error-message1 password1 pwd_not_match not_equal"></div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">{!! trans('home/settings.formPasswordNew') !!}</label>
                                                        <input class="icoForm__input" type="password" name="password" placeholder="{!! trans('home/settings.formPassPlaceNew') !!}">
                                                    </div>
                                                    <div class="error-message error-message2 password"></div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">{!! trans('home/settings.formPasswordRepeat') !!}</label>
                                                        <input class="icoForm__input" type="password" name="password_confirmation" placeholder="{!! trans('home/settings.formPassPlaceRepeat') !!}">
                                                    </div>
                                                    <div class="error-message error-message2 password2 not_equal"></div>
                                                    <button type="submit" class="btn btn--small">{!! trans('modals/modals.change_btn') !!}</button>
                                                </form>

                                                <form class="icoForm changeEmail icoForm--noMargin hidden" action="{{ route('email.reset') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <div class="formControl formControl--noMargin">
                                                        <label class="icoForm__label">{!! trans('home/settings.formEmailOld') !!}</label>
                                                        <input class="icoForm__input" type="email" name="old_email" placeholder="{!! trans('home/settings.formEmailPlaceOld') !!}">
                                                    </div>
                                                    <div class="error-message error-message0 old_email not_your_email not_equal"></div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">{!! trans('home/settings.formEmailNew') !!}</label>
                                                        <input class="icoForm__input" type="email" name="email" placeholder="{!! trans('home/settings.formEmailPlaceNew') !!}" required>
                                                    </div>
                                                    <div class="error-message error-message1 email not_equal is_taken"></div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">{!! trans('home/settings.formEmailPass') !!}</label>
                                                        <input class="icoForm__input" type="password" name="password" placeholder="{!! trans('home/settings.formEmailPlacePass') !!}">
                                                    </div>
                                                    <div class="error-message error-message2 password pwd_not_match"></div>
                                                    <button type="submit" class="btn btn--small"> {!! trans('modals/modals.change_btn') !!}</button>
                                                </form>
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