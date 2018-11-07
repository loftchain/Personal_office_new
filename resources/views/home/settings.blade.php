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
                                @elseif(!Auth::user()->password)
                                    <div class="alert alert-danger" role="alert">
                                        Enter password
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
                                                       @include('modals.lang_selector')
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                {{--password change form--}}
                                                @if(!Auth::user()->password)
                                                    <form class="icoForm changePassword icoForm--noMargin hidden" action="{{ route('password.set') }}" method="post">
                                                        {{ csrf_field() }}
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
                                                @else
                                                    @include('home.settings.form_password')
                                                @endif

                                                {{--mail change form--}}
                                                @if(!Auth::user()->email)
                                                    <form class="icoForm changeEmail icoForm--noMargin hidden" action="{{ route('email.reset') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="error-message error-message0 old_email not_your_email not_equal"></div>
                                                        <div class="formControl">
                                                            <label class="icoForm__label">{!! trans('home/settings.formEmailNew') !!}</label>
                                                            <input class="icoForm__input" type="email" name="email" placeholder="{!! trans('home/settings.formEmailPlaceNew') !!}" required>
                                                        </div>
                                                        <div class="error-message error-message1 email"></div>
                                                        <button type="submit" class="btn btn--small"> {!! trans('modals/modals.change_btn') !!}</button>
                                                    </form>
                                                @else
                                                    @include('home.settings.form_email')
                                                @endif
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
