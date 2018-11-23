<div class="raisedContainer">
    <div class="basicBlock">
        <div class="basicBlock__content">
            <div class="basicBlock__title">{!! trans('home/home.totally_raised') !!}</div>
            <div class="percentBar" data-percent="{{ number_format($data['totalUSDCollected'] / (env('ICO_HARD_CAP') / 100), 0, '.', ' ') }}"> <span class="percentBar__fill"></span><span class="percentBar__marker" style="{{ number_format($data['totalUSDCollected'] / (env('ICO_HARD_CAP') / 100), 0, '.', ' ') == '0' ? 'margin-left: 0px' : '' }}"></span><span class="percentBar__number"> </span></div>
            <div class="raisedSlider">
                {{--<div class="owl-carousel owl-theme">--}}
                    <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/eth.svg" alt="eth"><span class="raisedSlider__itemValue">{{ number_format($data['ethCurrentAmount']['currency'], 2, '.', ' ') }}</span></div>
                    <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/btc.svg" alt="btc"><span class="raisedSlider__itemValue">{{ number_format($data['btcCurrentAmount']['currency'], 2, '.', ' ') }}</span></div>
                    {{--<div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">{{ number_format($data['payPalCurrentAmount']) }} $</span></div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>