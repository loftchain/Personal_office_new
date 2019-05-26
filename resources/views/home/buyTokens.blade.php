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
                @include('home.buy_tokens.calc')

                @include('home.buy_tokens.title')

                @include('home.buy_tokens.fakeblock')

                <div id="blockEth" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('home.buy_tokens.eth_form')
                </div>
                <div id="blockBtc" class="blockHolder blockHolder--token blockHolder--hide">
                    @include('home.buy_tokens.btc_form')
                </div>
                @if(Auth::user()->wallets()->first())
                    <div class="blockHolder" id="txTable">
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
