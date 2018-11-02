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