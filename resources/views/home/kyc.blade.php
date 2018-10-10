@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="messageTop">Unfortunately your profile is not verified yet.</div>
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
                                    <input class="checkbox" type="checkbox" name="agreement" id="agreement">
                                    <label for="agreement">I agree with the terms of use</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <form class="icoForm" action="#" method="post" enctype="multipart/form-data">
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
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="icoForm__selectContainer icoForm__selectContainer--margin">
                                                            <select class="icoForm__select" name="month">
                                                                <option value="">Month</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="icoForm__selectContainer">
                                                            <select class="icoForm__select" name="year">
                                                                <option value="">Year</option>
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
                                </form>
                                <div class="text-center">
                                    <input class="btn btn--small" type="submit" value="Send">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection