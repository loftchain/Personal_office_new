@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        {{--@if(!Auth::user()->confirmed)--}}
            <div class="messageTop">
                <p class="messageTop__text"></p>
            </div>
        {{--@endif--}}
        <div class="scrollHolder">
            <div class="content" id="buyTokens">
                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--full">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">{!! trans('home/buyTokens.buyTokens') !!}</div>
                                <div class="basicBlock__subtitle text-center">{!! trans('home/buyTokens.chooseTokens') !!}</div>
                                <div class="cryptoSelector">
                                    <button class="cryptoSelector__item" id="buttonEth">Etherium</button>
                                    <button class="cryptoSelector__item" id="buttonBtc">Bitcoin</button>
                                    <button class="cryptoSelector__item" id="buttonPay">PayPal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="blockFake" class="blockHolder blockHolder--token">
                    <div class="raisedContainer raisedContainer--disabled">
                        <div class="basicBlock">
                            <div class="basicBlock__content">
                                <div class="loginForm icoForm">
                                    <div id="formEth">
                                        <form>
                                            <div class="formControl">
                                                <input type="hidden" name="type" class="type">
                                                <input type="hidden" name="currency" class="currency" value="ETH">
                                                <label class="icoForm__label">{!! trans('home/buyTokens.formEth') !!}</label>
                                                <input id="wallet" data-currency="ETH" class="wallet icoForm__input icoForm__input--pencil" type="text" name="wallet" required>
                                                <button class="icoForm__pencil icoForm__pencil--disabled"></button>
                                            </div>
                                            <div class="error-message wallet"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="raisedContainer raisedContainer--disabled">
                        <div class="basicBlock basicBlock">
                            <div class="basicBlock__content">
                                <form class="loginForm icoForm">
                                    <div class="row">
                                        <div class="col-md-4 align-self-top text-center">
                                            <div class="dropdown dropdown--qr">
                                                <img id="qrEth" class="qrCode" alt="qr" src="{{ asset('img/qr.jpg') }}">
                                                <div class="dropdown-content dropdown-content--qr">
                                                    <img width="200" height="200" class="qrCode" alt="qr" src="{{ asset('img/0x7E7884c00cF0032Dc9360A8294a97aDf8fD18B61.png') }}">
                                                </div>
                                            </div>
                                            <p class="dropdown__hint">{!! trans('home/buyTokens.qrHover') !!}</p>
                                        </div>
                                        <div class="col-md-8 align-self-top">
                                            <div class="formControl formControl--noMargin">
                                                <input class="icoForm__input icoForm__input--canCopy" type="text"  name="ethWallet" id="ethWallet"><span class="icoForm__copy"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="blockEth" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('modals.eth_form')
                </div>
                <div id="blockBtc" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('modals.btc_form')
                </div>
                <div id="blockPay" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('modals.payPal_form')
                </div>
                @if(Auth::user()->wallets()->first())
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">{!! trans('home/buyTokens.trans') !!}</div>
                                <div class="basicBlock__subtitle text-center">{!! trans('home/buyTokens.transText') !!}</div>
                                <div class="infoBtn"><a class="btn btn--small" href="#">h5723882302832cn8399c2</a></div>
                                <div class="dataTable">
                                    <table class="dataTable__list">
                                        <tr>
                                            <th>{!! trans('home/buyTokens.tableTransDate') !!}</th>
                                            <th>{!! trans('home/buyTokens.tableTransCurrency') !!}</th>
                                            <th>{!! trans('home/buyTokens.tableTransToken') !!}</th>
                                            <th>{!! trans('home/buyTokens.tableTransStatus') !!}</th>
                                        </tr>
                                        @forelse($transactions as $transaction)
                                        <tr class="{{ $transaction->status == 'true' ? "dataTable__success" : 'dataTable__error' }}">
                                            <td>{{ $transaction->date }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>{{ $transaction->amount_tokens }}</td>
                                            <td>{{ $transaction->status }}</td>
                                        </tr>
                                        @empty
                                        <tr class="dataTable__error">
                                            <td colspan="4"><h3>{!! trans('home/buyTokens.tableNoTrans') !!}</h3></td>
                                        </tr>
                                        @endforelse
                                        <tr class="dataTable__summary">
                                            <td colspan="2"><span class="dataTable__address"><strong>{!! trans('home/buyTokens.tableSumTo') !!}</strong>: h5723882302832cn8399c2</span></td>
                                            <td colspan="2"><strong>{!! trans('home/buyTokens.tableSumInfo') !!}: </strong><a class="dataTable__link" href="#">h5723882302832cn8399c2</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>
    @push('scripts')
        @include('_js.js_wallet')
        @include('_js.js_copy_to_clipboard')
    @endpush
@endsection