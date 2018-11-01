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

                @if($data['stage'] === 0)
                    <div class="blockHolder">
                        <div class="timerContainer">
                            <div class="basicBlock">
                                <div class="basicBlock__content">
                                    <div class="basicBlock__title">{{ $data['stageTitle'] }}</div>
                                    <div class="timer">
                                        <div class="timer__number jsTimerDays">
                                            <div class="timer__numberValue" id="timer_days">00</div>
                                            <div class="timer__numberTitle">{!! trans('home/home.timer_day') !!}</div>
                                        </div>
                                        <div class="timer__dots"> </div>
                                        <div class="timer__number jsTimerHours">
                                            <div class="timer__numberValue" id="timer_hours">00</div>
                                            <div class="timer__numberTitle">{!! trans('home/home.timer_hour') !!}</div>
                                        </div>
                                        <div class="timer__dots">                                                       </div>
                                        <div class="timer__number jsTimerHours">
                                            <div class="timer__numberValue" id="timer_min">00</div>
                                            <div class="timer__numberTitle">{!! trans('home/home.timer_min') !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="raisedContainer">
                            <div class="basicBlock">
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
                                <div class="basicBlock__content basicBlock__content--preICO">
                                    <div class="basicBlock__title text-center basicBlock__title--vertical">{!! trans('home/home.ico_stage0_start') !!} {{ $data['stageEnd'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($data['stage'] === 1)
                        <div class="blockHolder">
                            <div class="timerContainer">
                                <div class="basicBlock">
                                    <div class="basicBlock__content">
                                        <div class="basicBlock__title">{{ $data['stageTitle'] }}</div>
                                        <div class="timer">
                                            <div class="timer__number jsTimerDays">
                                                <div class="timer__numberValue" id="timer_days">00</div>
                                                <div class="timer__numberTitle">{!! trans('home/home.timer_day') !!}</div>
                                            </div>
                                            <div class="timer__dots"> </div>
                                            <div class="timer__number jsTimerHours">
                                                <div class="timer__numberValue" id="timer_hours">00</div>
                                                <div class="timer__numberTitle">{!! trans('home/home.timer_hour') !!}</div>
                                            </div>
                                            <div class="timer__dots">                                                       </div>
                                            <div class="timer__number jsTimerHours">
                                                <div class="timer__numberValue" id="timer_min">00</div>
                                                <div class="timer__numberTitle">{!! trans('home/home.timer_min') !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="raisedContainer">
                                <div class="basicBlock">
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
                                            <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">{{ number_format($data['payPalCurrentAmountRound']) }} $</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($data['stage'] === 2)
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
                @endif

                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--deposit-bonus">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">{!! trans('home/home.deposit_bonus') !!}</div>
                                <div class="bonuses">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">29 {!! trans('home/home.ico_card_oct') !!} 2018 {!! trans('home/home.ico_card_to') !!} <span>27 {!! trans('home/home.ico_card_jan') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">30% </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">28 {!! trans('home/home.ico_card_jan') !!} 2019 {!! trans('home/home.ico_card_to') !!} <span>24 {!! trans('home/home.ico_card_feb') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">30%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">25 {!! trans('home/home.ico_card_feb') !!} 2019 {!! trans('home/home.ico_card_to') !!} <span>24 {!! trans('home/home.ico_card_mar') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">25%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">25 {!! trans('home/home.ico_card_mar') !!} 2019 {!! trans('home/home.ico_card_to') !!} <span>28 {!! trans('home/home.ico_card_apr') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">20%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">29 {!! trans('home/home.ico_card_apr') !!} 2019 {!! trans('home/home.ico_card_to') !!} <span>26 {!! trans('home/home.ico_card_may') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">15%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">27 {!! trans('home/home.ico_card_may') !!} 2019 {!! trans('home/home.ico_card_to') !!} <span>23 {!! trans('home/home.ico_card_june') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">10%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">24 {!! trans('home/home.ico_card_june') !!} 2019 {!! trans('home/home.ico_card_to') !!} <span>28 {!! trans('home/home.ico_card_jul') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">5%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">29 {!! trans('home/home.ico_card_jul') !!} 2019 {!! trans('home/home.ico_card_to') !!} <span>25 {!! trans('home/home.ico_card_aug') !!} 2019</span></div>
                                                <div class="bonuses__itemCaption">{!! trans('home/home.ico_bonus') !!}</div>
                                                <div class="bonuses__itemValue">{!! trans('home/home.ico_noBonus') !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--token-distribution">
                        <div class="basicBlock basicBlock--single basicBlock--without-line">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">{!! trans('home/home.token_distribution') !!}</div>
                                <div class="row">
                                    <div class="col-lg-8 align-self-center">
                                        <canvas id="tokenChart"></canvas>
                                    </div>
                                    <div class="col-lg-4 align-self-center">
                                        <div id="js-legend" class="legend-con chart-legend"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
