<div class="raisedContainer raisedContainer--wallet raisedContainer--disabled">
    <div class="basicBlock">
        <div class="basicBlock__content" id="formWallets">
            <div class="loginForm icoForm">
                <div id="formEth">
                    <form action="{{ route('home.tokens.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="formControl">
                            <input type="hidden" name="type" class="type" value="from_to">
                            <input type="hidden" name="currency" class="currency" value="ETH">
                            <label class="icoForm__label">{!! trans('home/buyTokens.formEth') !!}</label>
                            <input id="wallet" data-currency="ETH" class="wallet icoForm__input icoForm__input--pencil" type="text" name="wallet" required>
                            <button class="icoForm__pencil icoForm__pencil--disabled" type="submit"></button>
                        </div>
                        <div class="error-message wallet"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="raisedContainer raisedContainer--disabled raisedContainer--qr-1">
    <div class="basicBlock basicBlock">
        <div class="basicBlock__content" id="formQr">
            <form class="loginForm icoForm" action="#">
                <div class="row">
                    <div class="col-md-4 align-self-top text-center">
                        <div class="dropdown dropdown--qr">
                            <img id="qrEth" class="qrCode" alt="qr" src="{{ asset('img/0x7E7884c00cF0032Dc9360A8294a97aDf8fD18B61.png') }}">
                            <div class="dropdown-content dropdown-content--qr">
                                <img width="200" height="200" class="qrCode" alt="qr" src="{{ asset('img/0x7E7884c00cF0032Dc9360A8294a97aDf8fD18B61.png') }}">
                            </div>
                        </div>
                        {{--<p class="dropdown__hint">{!! trans('home/buyTokens.qrHover') !!}</p>--}}
                    </div>
                    <div class="col-md-8 align-self-top">
                        <div class="formControl formControl--noMargin">
                            <input class="icoForm__input icoForm__input--canCopy" type="text" v-model="invsetmentWalletETH" name="ethWallet" id="ethWallet"><span class="icoForm__copy" v-on:click="copyToBuffer"> </span>
                        </div>
                        {{--{{minumumDeposit}}--}}
                        <div class="minumudDeposit">{!! trans('home/buyTokens.minDep') !!}</div>
                        {{--{{gas}}--}}
                        <div class="setGas">{!! trans('home/buyTokens.setGas') !!} gas</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>