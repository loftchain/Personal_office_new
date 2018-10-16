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
            <div class="content">
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">WHITE PAPER CONDITIONS</div>
                                <div class="basicBlock__subtitle text-center">please read the white paper and agree to the proposed conditions</div>
                                <div class="btnConainer text-center"><a class="btn btn--whitePaper btn--small" href="https://drive.google.com/file/d/12MKdsHPQLQEqS5Ep9sO3BI30FJ1fGso-/view" target="_blank">Read the white paper</a></div>
                                <div class="agreement text-center">
                                    <input class="checkbox" type="checkbox" name="agreement" id="agreement" {{ $personal ? 'checked' : '' }}>
                                    <label for="agreement">I agree with the terms of use</label>
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
                                                <label class="icoForm__label">Full name</label>
                                                <input class="icoForm__input" type="text" name="name" required>
                                            </div>
                                            <div class="formControl">
                                                <label class="icoForm__label">Phone</label>
                                                <input class="icoForm__input" type="text" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="formControl">
                                                <label class="icoForm__label">Date of birth</label>
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <div class="icoForm__selectContainer">
                                                            <select class="icoForm__select" name="day">
                                                                <option value="">Day   </option>
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
                                                                <option value="">Month</option>
                                                                <option value="January">January</option>
                                                                <option value="February">February</option>
                                                                <option value="March">March</option>
                                                                <option value="April">April</option>
                                                                <option value="May">May</option>
                                                                <option value="June">June</option>
                                                                <option value="July">July</option>
                                                                <option value="August">August</option>
                                                                <option value="September">September</option>
                                                                <option value="October">October</option>
                                                                <option value="November">November</option>
                                                                <option value="December">December</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="icoForm__selectContainer">
                                                            <select class="icoForm__select" name="year">
                                                                <option value="">Year</option>
                                                                @for($i = 1960; $i <= 2018; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formControl">
                                                <label class="icoForm__label">ZIP Code</label>
                                                <input class="icoForm__input" type="text" name="zip" required>
                                            </div>
                                        </div>
                                    </div>
                                    @captcha
                                    <div class="text-center">
                                        <button type="submit" class="btn btn--small">Send</button>
                                    </div>
                                </form>
                                @elseif(Auth::user()->confirmed)
                                    <center><h6>Your account has been successfully verified.</h6></center>
                                @else
                                    <center><h6>Thank you, wait for confirmation from the administration. A letter will be sent to your email address.</h6></center>
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