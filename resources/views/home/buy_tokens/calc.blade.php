<div class="blockHolder">
    <div class="raisedContainer raisedContainer--full">
        <div class="basicBlock basicBlock--single">
            <div class="basicBlock__content">
                <div class="basicBlock__title text-center">{!! trans('home/buyTokens.calcInvestmentsTitle') !!}*</div>
                <div class="basicBlock__bonusText text-center">{!! trans('home/buyTokens.currentBonus') !!} {{$calcData['bonus']}}%</div>
                <div class="calculation-wrapper">
                    <div class="calculation-wrapper__left">
                        <div class="formControl">
                            <label for="MTSHInput" class="icoForm__label">MTSH</label>
                            <input name="MTSHInput" id="MTSHInput" class="icoForm__input" type="text">
                        </div>
                    </div>
                    <div class="calculation-wrapper__right">
                        <div class="formControl">
                            <label for="USDInput" class="icoForm__label">USD</label>
                            <input name="USDInput" id="USDInput" type="text" class="icoForm__input">
                            <label for="ETHInput" class="icoForm__label">ETH</label>
                            <input name="ETHInput" id="ETHInput" type="text" class="icoForm__input">
                            <label for="BTCInput" class="icoForm__label">BTC</label>
                            <input name="BTCInput" id="BTCInput" type="text" class="icoForm__input">
                        </div>
                    </div>
                </div>
                <p>*<small>{!! trans('home/buyTokens.volatility') !!}</small></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @include('_js.js_calc', $calcData)
@endpush
