@extends('layouts.app')

@section('content')
            <div class="workArea jsWorkArea">
                <div class="mobileMenuBtn">
                    <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
                </div>
                @if(!Auth::user()->confirmed)
                    <div class="messageTop">Unfortunately your profile is not verified yet.</div>
                @endif
                <div class="scrollHolder">
                    <div class="content" id="buyTokens">
                        <div class="blockHolder">
                            <div class="raisedContainer basicBlock--settings">
                                @if(Auth::user()->email == null)
                                <div class="alert alert-danger" role="alert">
                                    Укажите ваш email! Только после этого вы сможете пользоваться сервисом!
                                </div>
                                @endif
                                <div class="basicBlock basicBlock--single">
                                    <div class="basicBlock__content">
                                        <div class="basicBlock__title text-left">Settings</div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="avatarSettings">
                                                    <div class="avatarSettings__imageHolder"><img class="avatarSettings__image" src="../img/avatar-big.jpg">
                                                        <form class="icoForm icoForm--noMargin" action="#" method="post" enctype="multipart/form-data">
                                                            <label class="avatarSettings__uploadBtn" for="avatarUpload">
                                                                <input class="hiddenInput" type="file" id="avatarUpload" name="avatarUpload" value="">
                                                            </label>
                                                        </form>
                                                    </div>
                                                    <div class="avatarSettings__note">Upload photo not more than 1mb </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <form class="icoForm icoForm--noMargin" action="#">
                                                    <div class="formControl formControl--noMargin">
                                                        <label class="icoForm__label">Name</label>
                                                        <input class="icoForm__input" type="text" name="name" value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">Email</label>
                                                        <input class="icoForm__input" type="text" name="email" disabled value="{{ Auth::user()->email }}">
                                                    </div>
                                                </form>
                                                <div class="settingsActions"><a class="settingsActions__link jsChangeEmail" href="#">Change e-mail    </a><a class="settingsActions__link jsChangePassword" href="#">Change password</a>
                                                    <div class="settingsActions__langSelector"><span class="settingsActions__langSelectorBtn">RU</span><span class="settingsActions__langSelectorBtn settingsActions__langSelectorBtn--active">ENG</span></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <form class="icoForm changePassword icoForm--noMargin hidden" action="#">
                                                    <div class="formControl formControl--noMargin">
                                                        <label class="icoForm__label">Old password</label>
                                                        <input class="icoForm__input" type="password" name="name" value="Name Name">
                                                    </div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">New password</label>
                                                        <input class="icoForm__input" type="password" name="name" value="Name Name">
                                                    </div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">Repeat password</label>
                                                        <input class="icoForm__input" type="password" name="name" value="Name Name">
                                                    </div>
                                                </form>
                                                <form class="icoForm changeEmail icoForm--noMargin hidden" action="{{ route('email.reset') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <div class="formControl formControl--noMargin">
                                                        <label class="icoForm__label">Your email</label>
                                                        <input class="icoForm__input" type="email" name="old_email" placeholder="Your email address if you have">
                                                    </div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">New email</label>
                                                        <input class="icoForm__input" type="email" name="email" placeholder="Your new email" required>
                                                    </div>
                                                    <div class="formControl">
                                                        <label class="icoForm__label">Password</label>
                                                        <input class="icoForm__input" type="password" name="password" placeholder="Your password if you have">
                                                    </div>
                                                    <button type="submit" class="btn btn--small">Edit</button>
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
    @endsection