@extends('layouts.app')

@section('content')
    @push('links')
        <link rel="stylesheet" href="{{ asset('css/fine-uploader-gallery.min.css') }}">
    @endpush
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
                    <div class="raisedContainer raisedContainer--full">
                        <div class="basicBlock basicBlock--single">
                            @include('home.kyc.wp')
                        </div>
                    </div>
                </div>
                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--full">
                        <div class="basicBlock basicBlock--single">
                            @if(!$personal)
                            <div class="basicBlock__content basicBlock__content--verification" id="divContent">
                                @include('home.kyc.form_kyc')
                            </div>

                                <div id="fakeConfirmed" class="basicBlock__content basicBlock__form basicBlock__form--waiting" style="display: none">
                                    <div class="basicBlock__form-text">{!! trans('home/kyc.nKyc_title') !!}</div>
                                    <div class="basicBlock__form-img basicBlock__form-img--waiting">
                                        <img src="{{ asset('img/form-success.svg') }}" alt="wait for confirmation">
                                    </div>
                                </div>

                                @elseif(Auth::user()->confirmed)
                                    <div class="basicBlock__content basicBlock__form basicBlock__form--success">
                                        <div class="basicBlock__form-text">{!! trans('home/kyc.vKyc_title') !!}</div>
                                        <div class="basicBlock__form-img basicBlock__form-img--success">
                                            <img src="{{ asset('img/form-success.svg') }}" alt="successfully verified">
                                        </div>
                                    </div>
                                @else
                                    <div class="basicBlock__content basicBlock__form basicBlock__form--waiting">
                                        <div class="basicBlock__form-text">{!! trans('home/kyc.nKyc_title') !!}</div>
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
    @push('scripts')
        <script src="{{ asset('js/fine-uploader.min.js') }}"></script>
        @include('home.kyc.fine_uploader_script')
        @include('_js.js_verification')
        @include('_js.js_uploader')
    @endpush
@endsection