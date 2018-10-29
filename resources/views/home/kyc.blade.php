@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/fine-uploader-gallery.min.css') }}">
    @push('links')
    @endpush
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
{{--        @if(!Auth::user()->confirmed)--}}
            <div class="messageTop">
                <p class="messageTop__text"></p>
            </div>
        {{--@endif--}}
        <div class="scrollHolder">
            <div class="content">
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">WHITE PAPER CONDITIONS</div>
                                <div class="basicBlock__subtitle text-center">please read the white paper and agree to the proposed conditions</div>
                                <div class="btnConainer text-center"><a class="btn btn--whitePaper btn--small" href="#" target="_blank">Read the white paper</a></div>
                                <div class="agreement text-center">
                                    <input class="checkbox" type="checkbox" name="agreement" id="agreement" {{ $personal ? 'checked' : '' }}>
                                    <label for="agreement">{!! trans('home/kyc.whitePaper_checkBox') !!}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content basicBlock__content--verification" id="divContent">
                                @if(!$personal)
                                <form id="formKyc" class="icoForm" action="{{ route('home.kyc.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="dropzone clearfix">
                                                <div class="wrapper">
                                                    <div class="drop">
                                                        {{--<div class="cont">--}}
                                                            {{--<div class="tit"><img src="{{ asset('img/plus.svg') }}" alt="add"></div>--}}
                                                            {{--<div class="desc">Drag and drop the image of your ID accepted formats: jpg, jpeg, png, svg, pdf, zip, rar</div>--}}
                                                        {{--</div>--}}
                                                        {{--<output id="list"></output>--}}
                                                        {{--<input id="files" multiple="true" name="files[]" type="file">--}}
                                                        <div id="fine-uploader-gallery"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="formControl">
                                                <label class="icoForm__label" for="full-name">{!! trans('home/kyc.kyc_fullName') !!}</label>
                                                <input class="icoForm__input" id="full-name" type="text" name="name" required>
                                            </div>
                                            <div class="error-message name"></div>
                                            <div class="formControl">
                                                <label class="icoForm__label" for="phone-number">{!! trans('home/kyc.kyc_phone') !!}</label>
                                                <input class="icoForm__input" id="phone-number" type="text" name="phone" required>
                                            </div>
                                            <div class="error-message phone"></div>
                                            <div class="formControl">
                                                <label class="icoForm__label" for="permanent-address">Permanent address</label>
                                                <input class="icoForm__input" id="permanent-address" type="text" name="address" required>
                                            </div>
                                            <div class="error-message address"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="formControl">
                                                <label class="icoForm__label" for="birthday">{!! trans('home/kyc.kyc_dateOfBirth') !!}</label>
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <div class="icoForm__selectContainer">
                                                            <select class="icoForm__select" id="birthday" name="day">
                                                                <option value="">{!! trans('home/kyc.kyc_day') !!}   </option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                                <option value="29">29</option>
                                                                <option value="30">30</option>
                                                                <option value="31">31</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="icoForm__selectContainer icoForm__selectContainer--margin">
                                                            <select class="icoForm__select" name="month">
                                                                <option value="">{!! trans('home/kyc.kyc_month') !!}</option>
                                                                <option value="January">{!! trans('home/kyc.kyc_monthJanuary') !!}</option>
                                                                <option value="February">{!! trans('home/kyc.kyc_monthFebruary') !!}</option>
                                                                <option value="March">{!! trans('home/kyc.kyc_monthMarch') !!}</option>
                                                                <option value="April">{!! trans('home/kyc.kyc_monthApril') !!}</option>
                                                                <option value="May">{!! trans('home/kyc.kyc_monthMay') !!}</option>
                                                                <option value="June">{!! trans('home/kyc.kyc_monthJune') !!}</option>
                                                                <option value="July">{!! trans('home/kyc.kyc_monthJuly') !!}</option>
                                                                <option value="August">{!! trans('home/kyc.kyc_monthAugust') !!}</option>
                                                                <option value="September">{!! trans('home/kyc.kyc_monthSeptember') !!}</option>
                                                                <option value="October">{!! trans('home/kyc.kyc_monthOctober') !!}</option>
                                                                <option value="November">{!! trans('home/kyc.kyc_monthNovember') !!}</option>
                                                                <option value="December">{!! trans('home/kyc.kyc_monthDecember') !!}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="icoForm__selectContainer">
                                                            <select class="icoForm__select" name="year">
                                                                <option value="">{!! trans('home/kyc.kyc_year') !!}</option>
                                                                @for($i = 1960; $i <= 2018; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="error-message error-message2 password2 not_equal"></div>
                                            <div class="formControl">
                                                <label class="icoForm__label" for="zip-code">{!! trans('home/kyc.kyc_zipCode') !!}</label>
                                                <input class="icoForm__input" id="zip-code" type="text" name="zip" required>
                                            </div>
                                            <div class="error-message zip"></div>
                                            <div class="formControl">
                                                <label class="icoForm__label" for="telegram">Telegram</label>
                                                <input class="icoForm__input" id="telegram" type="text" name="telegram">
                                            </div>
                                            <div class="error-message telegram"></div>
                                        </div>
                                    </div>

                                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                                    <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn--small">{!! trans('home/kyc.kyc_btnSend') !!}</button>
                                    </div>
                                </form>
                                @elseif(Auth::user()->confirmed)
                                    <div class="basicBlock__content basicBlock__form basicBlock__form--success">
                                        <div class="basicBlock__form-text">Thank you, wait for confirmation from the administration. A letter will be sent to  your email address</div>
                                        <div class="basicBlock__form-img basicBlock__form-img--success">
                                            <img src="{{ asset('img/form-success.svg') }}" alt="successfully verified">
                                        </div>
                                    </div>
                                @else
                                    <div class="basicBlock__content basicBlock__form basicBlock__form--waiting">
                                        <div class="basicBlock__form-text">Thank you, wait for confirmation from the administration. A letter will be sent to  your email address</div>
                                        <div class="basicBlock__form-img basicBlock__form-img--waiting">
                                            <img src="{{ asset('img/form-success.svg') }}" alt="wait for confirmation">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/fine-uploader.min.js') }}"></script>
        <script type="text/template" id="qq-template-gallery">
            <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
                <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                </div>
                <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                    <span class="qq-upload-drop-area-text-selector"></span>
                </div>
                <div class="qq-upload-button-selector qq-upload-button">
                    <div>Drag and drop the image of your ID
                        accepted formats: jpg, jpeg, png, svg, pdf, zip, rar</div>
                </div>
                <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
                <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
                    <li>
                        <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                        <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                        </div>
                        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                        <div class="qq-thumbnail-wrapper">
                            <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                        </div>
                        {{--<button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>--}}
                        <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                            <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                            Retry
                        </button>

                        <div class="qq-file-info">
                            <div class="qq-file-name">
                                <span class="qq-upload-file-selector qq-upload-file"></span>
                                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                            </div>
                            <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                            <span class="qq-upload-size-selector qq-upload-size"></span>
                            <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                                <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                            </button>
                            <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                                <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                            </button>
                            <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                                <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                            </button>
                        </div>
                    </li>
                </ul>

                <dialog class="qq-alert-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">Close</button>
                    </div>
                </dialog>

                <dialog class="qq-confirm-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">No</button>
                        <button type="button" class="qq-ok-button-selector">Yes</button>
                    </div>
                </dialog>

                <dialog class="qq-prompt-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <input type="text">
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">Cancel</button>
                        <button type="button" class="qq-ok-button-selector">Ok</button>
                    </div>
                </dialog>
            </div>
        </script>
        @include('_js.js_verification')
        @include('_js.js_uploader')
    @endpush
@endsection