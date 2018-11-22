<div class="blockHolder">
    <div class="raisedContainer">
        <div class="basicBlock basicBlock--single">
            <div class="basicBlock__content">
                <div class="basicBlock__title text-center">{{ $data['roundName'] }}</div>
                <div class="percentBar" data-percent="0" id="pre-sale-precent"> <span class="percentBar__fill" id="pre-sale-fill"></span><span class="percentBar__marker" id="pre-sale-marker"></span><span class="percentBar__number"id="pre-sale-number"> </span></div>
                <div class="period">
                    <div class="period__from"> from  {{ $data['stageBegin'] }}</div>
                    <div class="period__to"> till  {{ $data['stageEnd'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blockHolder">
    <div class="timerContainer">
        <div class="basicBlock">
            <div class="basicBlock__content">
                <div class="basicBlock__title">{!! trans('home/home.round_info') !!}</div>
                <div class="basicBlock__text">
                    <p>Soft Cap: {{ number_format(env('ICO_SOFT_CAP')) }}$</p>
                    <p>Hard cap: {{ number_format(env('ICO_HARD_CAP')) }}$</p>
                    <p>{!! trans('home/home.round_currentPrice') !!} {{ isset($data['currentPrice']) ? $data['currentPrice'] . '$' : 'Not for sale'}}</p>
                    <p>{!! trans('home/home.round_minDeposit') !!} {{ env('MIN_DEP_ETH') }} ETH</p><br>
                </div>
            </div>
        </div>
    </div>
    <div class="raisedContainer">
        <div class="basicBlock">
            <div class="basicBlock__content">
                <div class="basicBlock__title">{!! trans('home/home.round_raised') !!} {{ $data['roundName'] }}</div>
                <div class="raisedSlider">
                    <div class="owl-carousel owl-theme">
                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/eth.svg" alt="eth"><span class="raisedSlider__itemValue">{{ number_format($data['ethCurrentAmountRound']['currency'], 2, '.', ' ') }}</span></div>
                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/btc.svg" alt="btc"><span class="raisedSlider__itemValue">{{ number_format($data['btcCurrentAmountRound']['currency'], 2, '.', ' ') }}</span></div>
                        {{--<div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">{{ number_format($data['payPalCurrentAmountRound']) }} $</span></div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>