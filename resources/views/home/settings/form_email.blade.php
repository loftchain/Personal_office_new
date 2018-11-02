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