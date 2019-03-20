<form id="formKyc" class="icoForm" action="{{ route('home.kyc.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            {{--<div class="dropzone clearfix">--}}
                {{--<div class="wrapper">--}}
                    {{--<div class="drop">--}}
                        {{--<div id="fine-uploader-gallery"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="col-md-6">
            <div class="formControl">
                <label class="icoForm__label" for="full-name">{!! trans('home/kyc.kyc_fullName') !!}</label>
                <input class="icoForm__input kyc-required-js" id="full-name" type="text" name="name" required>
            </div>
            <div class="error-message name"></div>
            <div class="formControl">
                <label class="icoForm__label" for="phone-number">{!! trans('home/kyc.kyc_phone') !!}</label>
                <input class="icoForm__input kyc-required-js" id="phone-number" type="text" name="phone" required>
            </div>
            <div class="error-message phone"></div>
            <div class="formControl">
                <label class="icoForm__label" for="permanent-address">Permanent address</label>
                <input class="icoForm__input kyc-required-js" id="permanent-address" type="text" name="address" required>
            </div>
            <div class="error-message address"></div>
        </div>
        <div class="col-md-6">
            <div class="formControl">
                @include('home.kyc.form_date')
            </div>
            <div class="error-message date-of-birth"></div>
            <div class="formControl">
                <label class="icoForm__label" for="zip-code">{!! trans('home/kyc.kyc_zipCode') !!}</label>
                <input class="icoForm__input kyc-required-js" id="zip-code" type="text" name="zip" required>
            </div>
            <div class="error-message zip"></div>
            <div class="formControl">
                <label class="icoForm__label" for="telegram">Telegram</label>
                <input class="icoForm__input" id="telegram" type="text" name="telegram">
            </div>
            <div class="error-message telegram"></div>
        </div>
    </div>
    @if(env('APP_ENV') != 'local')
        <div class="g-recaptcha g-recaptcha--verification" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
        <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
    @endif

    <div class="text-center">
        <button id="trigger-upload" type="submit" class="btn btn--small">{!! trans('home/kyc.kyc_btnSend') !!}</button>
    </div>
</form>
