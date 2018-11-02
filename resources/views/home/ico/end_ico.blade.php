<div class="blockHolder">
    <div class="raisedContainer">
        <div class="basicBlock basicBlock--single">
            <div class="basicBlock__content">
                <div class="basicBlock__title">{!! trans('home/home.totally_raised') !!}</div>
                <div class="percentBar" data-percent="{{ number_format($data['totalUSDCollected'] / (env('ICO_HARD_CAP') / 100), 0, '.', ' ') }}"> <span class="percentBar__fill"></span><span class="percentBar__marker"></span><span class="percentBar__number"> </span></div>
                <div class="raisedSlider">
                    <div class="owl-carousel owl-theme">
                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/eth.svg" alt="eth"><span class="raisedSlider__itemValue">{{ number_format($data['ethCurrentAmount']['currency'], 2, '.', ' ') }}</span></div>
                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/btc.svg" alt="btc"><span class="raisedSlider__itemValue">{{ number_format($data['btcCurrentAmount']['currency'], 2, '.', ' ') }}</span></div>
                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">{{ number_format($data['payPalCurrentAmount']) }} $</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blockHolder">
    <div class="raisedContainer">
        <div class="basicBlock basicBlock--single">
            <div class="basicBlock__content">
                <div class="basicBlock__title text-center">{!! trans('home/home.ico_finished') !!}</div>
                <div class="percentBar" data-percent="100"> <span class="percentBar__fill"></span><span class="percentBar__marker"></span><span class="percentBar__number"> </span></div>
                <div class="period">
                    <div class="period__from"> from  {{ $data['stageBegin'] }}</div>
                    <div class="period__to"> till  {{ $data['stageEnd'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>