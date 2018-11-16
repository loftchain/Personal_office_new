@extends('layouts.app')

@section('content')
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
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">{!! trans('home/buyTokens.buyTokens') !!}</div>
                                <div class="basicBlock__subtitle text-center">{!! trans('home/buyTokens.chooseTokens') !!}</div>
                                <div class="cryptoSelector">
                                    <button class="cryptoSelector__item" id="buttonEth">Etherium</button>
                                    <button class="cryptoSelector__item" id="buttonBtc">Bitcoin</button>
                                    <button class="cryptoSelector__item" id="buttonPay">Changelly</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('home.buy_tokens.fakeblock')

                <div id="blockEth" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('modals.eth_form')
                </div>
                <div id="blockBtc" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('modals.btc_form')
                </div>
                <div id="blockPay" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('modals.changelly')
                </div>
                @if(Auth::user()->wallets()->first())
                    <div class="blockHolder">
                        @include('home.buy_tokens.txTable')
                    </div>
                @else
                    @include('home.buy_tokens.txFakeTable')
                @endif
            </div>
        </div>
    </div>
    @push('scripts')
        @include('_js.js_wallet')
        @include('_js.js_copy_to_clipboard')
        @include('_js.js_transactions')
    @endpush
@endsection
