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