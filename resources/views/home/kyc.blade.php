@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
{{--        @if(!Auth::user()->confirmed)--}}
            <div class="messageTop">Unfortunately your profile is not verified yet.</div>
        {{--@endif--}}
        <div class="scrollHolder">
            <div class="content">
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">{!! trans('home/kyc.whitePaper_title') !!}</div>
                                <div class="basicBlock__subtitle text-center">{!! trans('home/kyc.whitePaper_desc') !!}</div>
                                <div class="btnConainer text-center"><a class="btn btn--whitePaper btn--small" href="https://drive.google.com/file/d/12MKdsHPQLQEqS5Ep9sO3BI30FJ1fGso-/view" target="_blank">{!! trans('home/kyc.whitePaper_btn') !!}</a></div>
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
                            <div class="basicBlock__content" id="divContent">
                                @if(!$personal)
                                <form id="formKyc" class="icoForm" action="{{ route('home.kyc.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dropzone clearfix">
                                                <div class="wrapper">
                                                    <div class="drop">
                                                        <div class="cont">
                                                            <div class="tit"><img src="{{ asset('img/plus.svg') }}" alt="add"></div>
                                                            <div class="desc">Drag and drop the image of your ID accepted formats: jpg, jpeg, png, svg, pdf, zip, rar</div>
                                                        </div>
                                                        <output id="list"></output>
                                                        <input id="files" multiple="true" name="files[]" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="formControl">
                                                <label class="icoForm__label">{!! trans('home/kyc.kyc_fullName') !!}</label>
                                                <input class="icoForm__input" type="text" name="name" required>
                                            </div>
                                            <div class="formControl">
                                                <label class="icoForm__label">{!! trans('home/kyc.kyc_phone') !!}</label>
                                                <input class="icoForm__input" type="text" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="formControl">
                                                <label class="icoForm__label">{!! trans('home/kyc.kyc_dateOfBirth') !!}</label>
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <div class="icoForm__selectContainer">
                                                            <select class="icoForm__select" name="day">
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
                                            <div class="formControl">
                                                <label class="icoForm__label">{!! trans('home/kyc.kyc_zipCode') !!}</label>
                                                <input class="icoForm__input" type="text" name="zip" required>
                                            </div>
                                        </div>
                                    </div>
                                    @captcha
                                    <div class="text-center">
                                        <button type="submit" class="btn btn--small">{!! trans('home/kyc.kyc_btnSend') !!}</button>
                                    </div>
                                </form>
                                @elseif(Auth::user()->confirmed)
                                    <center><h6>{!! trans('home/kyc.vKyc_title') !!}</h6></center>
                                @else
                                    <center><h6>{!! trans('home/kyc.nKyc_title') !!}</h6></center>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @include('_js.js_verification')
    @endpush
@endsection