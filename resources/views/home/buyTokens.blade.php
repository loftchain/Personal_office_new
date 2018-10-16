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
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">Purchase of tokens</div>
                                <div class="basicBlock__subtitle text-center">Choose which currency you want to invest in</div>
                                <div class="cryptoSelector">
                                    <button class="cryptoSelector__item cryptoSelector__item--active" id="buttonEth">Etherium</button>
                                    <button class="cryptoSelector__item" id="buttonBtc">Bitcoin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock">
                            <div class="basicBlock__content" id="formWallets">
                                {{--<form class="loginForm icoForm" action="{{ route('home.tokens.store') }}" method="post">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<input type="hidden" name="type" value="from">--}}
                                    {{--<div class="formControl">--}}
                                        {{--<label class="icoForm__label">ETH wallet  for investing and receiving tokens</label>--}}
                                        {{--<input class="icoForm__input icoForm__input--pencil" type="text" name="ethWallet"><span class="icoForm__pencil"></span>--}}
                                    {{--</div>--}}
                                    {{--<div class="formControl">--}}
                                        {{--<label class="icoForm__label">Enter your BTC wallet for investment</label>--}}
                                        {{--<input class="icoForm__input icoForm__input--pencil" type="text" name="btcWallet"><span class="icoForm__pencil"></span>--}}
                                    {{--</div>--}}
                                    {{--<button type="submit" class="btn btn--small">Send</button>--}}
                                {{--</form>                                --}}
                                <div class="loginForm icoForm">
                                    <div id="formEth">
                                        @include('modals.eth_form')
                                    </div>

                                    <div id="formBtc" style="display: none">
                                        @include('modals.btc_form')
                                    </div>
                                {{--<form action="{{ route('home.tokens.store') }}" method="post">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<div class="formControl">--}}
                                        {{--<input type="hidden" name="type" class="type" value="from">--}}
                                        {{--<input type="hidden" name="currency" class="currency" value="ETH">--}}
                                        {{--<label class="icoForm__label">ETH wallet  for investing and receiving tokens</label>--}}
                                        {{--<input id="wallet1" data-currency="ETH" class="wallet icoForm__input icoForm__input--pencil" type="text" name="wallet">--}}
                                        {{--<span class="icoForm__pencil"></span>--}}
                                    {{--</div>--}}
                                    {{--<div class="error-message wallet"></div>--}}
                                {{--</form>--}}
                                {{--<form action="{{ route('home.tokens.store') }}" method="post">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<div class="formControl">--}}
                                        {{--<input type="hidden" name="type" class="type" value="to">--}}
                                        {{--<input type="hidden" name="currency" class="currency" value="BTC">--}}
                                        {{--<label class="icoForm__label">Enter your BTC wallet for investment</label>--}}
                                        {{--<input id="wallet2" data-currency="BTC"  class="wallet icoForm__input icoForm__input--pencil" type="text" name="wallet">--}}
                                        {{--<span class="icoForm__pencil"></span>--}}
                                    {{--</div>--}}
                                    {{--<div class="error-message wallet"></div>--}}
                                {{--</form>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock">
                            <div class="basicBlock__content">
                                <form class="loginForm icoForm" action="#">
                                    <div class="row">
                                        <div class="col-md-3 align-self-top text-center"><img class="qrCode" alt="qr" src="{{ asset('img/qr.jpg') }}"></div>
                                        <div class="col-md-9 align-self-top">
                                            <div class="formControl formControl--noMargin">
                                                <input class="icoForm__input icoForm__input--canCopy" type="text" v-model="invsetmentWalletETH" name="ethWallet" id="ethWallet"><span class="icoForm__copy" v-on:click="copyToBuffer"> </span>
                                            </div>
                                            {{--{{minumumDeposit}}--}}
                                            <div class="minumudDeposit">Minimum deposit amount: minumumDeposit ETH</div>
                                            {{--{{gas}}--}}
                                            <div class="setGas">Set GAS: gas</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->wallets()->first())
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">tRANSACTIONS</div>
                                <div class="basicBlock__subtitle text-center">Thank you for your participation! You can see your transactions</div>
                                <div class="infoBtn"><a class="btn btn--small" href="#">h5723882302832cn8399c2</a></div>
                                <div class="dataTable">
                                    <table class="dataTable__list">
                                        <tr>
                                            <th>Date</th>
                                            <th>Currency</th>
                                            <th>Token</th>
                                            <th>Status</th>
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
                                            <td colspan="4"><h3>No transactions</h3></td>
                                        </tr>
                                        @endforelse
                                        <tr class="dataTable__summary">
                                            <td colspan="2"><span class="dataTable__address"><strong>To</strong>: h5723882302832cn8399c2</span></td>
                                            <td colspan="2"><strong>Info: </strong><a class="dataTable__link" href="#">h5723882302832cn8399c2</a></td>
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
{{--        @include('_js.js_wallet')--}}
        @include('_js.js_test')
    @endpush
@endsection