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
                                    <img width="200" height="200" class="qrCode" alt="qr" src="{{ asset('img/0x1a503c973ff08f4985f3da21c9cf0164a586edb3.gif') }}">
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