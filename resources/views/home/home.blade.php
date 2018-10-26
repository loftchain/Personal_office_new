@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="messageTop">
            <button class="messageTop__button">Закрыть</button>
        </div>
        <div class="scrollHolder">
            <div class="content">
                <div class="blockHolder">
                    <div class="timerContainer">
                        <div class="basicBlock">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title">pre-sale ends in</div>
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
                                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">{{ number_format($data['totalUSDCollected'], 0, '.', ' ') }} $</span></div>
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
                                <div class="basicBlock__title text-center">pre-sale</div>
                                <div class="percentBar" data-percent="0" id="pre-sale-precent"> <span class="percentBar__fill" id="pre-sale-fill"></span><span class="percentBar__marker" id="pre-sale-marker"></span><span class="percentBar__number"id="pre-sale-number"> </span></div>
                                <div class="period">
                                    <div class="period__from"> from  {{ $data['stageBegin'] }}</div>
                                    <div class="period__to"> till  {{ $data['stageEnd'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($data['stageEnd'] === $data['dateNow'])
                    <div class="blockHolder">
                        <div class="raisedContainer">
                            <div class="basicBlock basicBlock--single">
                                <div class="basicBlock__content basicBlock__content--preICO">
                                    <div class="basicBlock__title text-center basicBlock__title--vertical">pre-ico starts at {{ $data['stageBegin'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blockHolder">
                        <div class="raisedContainer">
                            <div class="basicBlock basicBlock--single">
                                <div class="basicBlock__content">
                                    <div class="basicBlock__title">totalLy raised</div>
                                    <div class="percentBar" data-percent="90"> <span class="percentBar__fill"></span><span class="percentBar__marker"></span><span class="percentBar__number"> </span></div>
                                    <div class="raisedSlider">
                                        <div class="owl-carousel owl-theme">
                                            <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/eth.svg" alt="eth"><span class="raisedSlider__itemValue">78 ETH</span></div>
                                            <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/btc.svg" alt="btc"><span class="raisedSlider__itemValue">26 BTC</span></div>
                                            <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">702 000 000 $</span></div>
                                            <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/eth.svg" alt="eth"><span class="raisedSlider__itemValue">78 ETH</span></div>
                                            <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/btc.svg" alt="btc"><span class="raisedSlider__itemValue">26 BTC</span></div>
                                            <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">702 000 000 $</span></div>
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
                                    <div class="basicBlock__title text-center">ico is finished</div>
                                    <div class="percentBar" data-percent="100"> <span class="percentBar__fill"></span><span class="percentBar__marker"></span><span class="percentBar__number"> </span></div>
                                    <div class="period">
                                        <div class="period__from"> from  23.08.2018</div>
                                        <div class="period__to"> till  23.08.2018</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="blockHolder">
                    <div class="timerContainer">
                        <div class="basicBlock">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title">{!! trans('home/home.round_info') !!}</div>
                                <div class="basicBlock__text">
                                    <p>Hard cap: {{ env('ICO_HARD_CAP') }}$</p>
                                    <p>Soft Cap: {{ env('ICO_SOFT_CAP') }}$</p>
                                    <p>Current price: {{ isset($data['currentPrice']) ? $data['currentPrice'] . '$' : 'Not for sale'}}</p>
                                    <p>Minimum deposit amount: 0.1 ETH</p><br>
                                    <p>1 ETH = 13000 TGF</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="raisedContainer">
                        <div class="basicBlock">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title">raised during pre-sale</div>
                                <div class="raisedSlider">
                                    <div class="owl-carousel owl-theme">
                                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/eth.svg" alt="eth"><span class="raisedSlider__itemValue">{{ number_format($data['ethCurrentAmount']['currency'], 2, '.', ' ') }}</span></div>
                                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/btc.svg" alt="btc"><span class="raisedSlider__itemValue">{{ number_format($data['btcCurrentAmount']['currency'], 2, '.', ' ') }}</span></div>
                                        <div class="raisedSlider__item"><img class="raisedSlider__itemImage" src="img/paypal.svg" alt="paypal"><span class="raisedSlider__itemValue">{{ number_format($data['totalUSDCollected'], 0, '.', ' ') }} $</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--deposit-bonus">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="basicBlock__title text-center">{!! trans('home/home.deposit_bonus') !!}</div>
                                <div class="bonuses">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">29 Oct 2018 to <span>27 Jan 2019</span></div>
                                                <div class="bonuses__itemCaption"> Bonus</div>
                                                <div class="bonuses__itemValue">30% </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">28 Jan 2019 to <span>24 Feb 2019</span></div>
                                                <div class="bonuses__itemCaption">Bonus</div>
                                                <div class="bonuses__itemValue">30%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">25 Feb 2019 to <span>24 Mar 2019</span></div>
                                                <div class="bonuses__itemCaption">Bonus</div>
                                                <div class="bonuses__itemValue">25%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">25 Mar 2019 to <span>28 Apr 2019</span></div>
                                                <div class="bonuses__itemCaption">Bonus</div>
                                                <div class="bonuses__itemValue">20%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">29 Apr 2019 to <span>26 May 2019</span></div>
                                                <div class="bonuses__itemCaption">Bonus</div>
                                                <div class="bonuses__itemValue">15%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">27 May 2019 to <span>23 June 2019</span></div>
                                                <div class="bonuses__itemCaption">Bonus</div>
                                                <div class="bonuses__itemValue">10%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">24 June 2019 to <span>28 Jul 2019</span></div>
                                                <div class="bonuses__itemCaption">Bonus</div>
                                                <div class="bonuses__itemValue">5%</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-4 col-xl-3">
                                            <div class="bonuses__item">
                                                <div class="bonuses__itemTitle">29 Jul 2019 to <span>25 Aug 2019</span></div>
                                                <div class="bonuses__itemCaption">Bonus</div>
                                                <div class="bonuses__itemValue">no bonus</div>
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
