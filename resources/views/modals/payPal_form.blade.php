<div class="raisedContainer raisedContainer--full">
    <div class="basicBlock basicBlock--single">
        <div class="basicBlock__content">
            <form method="POST" action="{{ route('home.paypal') }}">
                {{ csrf_field() }}
                <h2 class="basicBlock__title">{!! trans('home/buyTokens.formPayPal_title') !!}</h2>
                <p class="basicBlock__subtitle text-left">{!! trans('home/buyTokens.formPayPal_invest') !!}</p>
                <div class="formControl">
                    <label class="icoForm__label"><b>{!! trans('home/buyTokens.formPayPal_enterAmount') !!}</b></label>
                    <input id="payPalAmount" class="wallet icoForm__input icoForm__input--pencil" name="amount" type="number" min="0">
                    <div class="message-error amount"></div>
                    </p>
                    <label class="icoForm__label"><b>{!! trans('home/buyTokens.formPayPal_enterEth') !!}</b></label>
                    <input data-currency="ETH" class="wallet icoForm__input icoForm__input--pencil" name="wallet" type="text">
                    <div class="message-error wallet"></div>
                    </p>
                    <button class="btn btn--small">{!! trans('home/buyTokens.formPayPal_Btn') !!}</button>
                </div>
            </form>
        </div>
    </div>
</div>
