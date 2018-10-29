<div class="raisedContainer raisedContainer--full">
    <div class="basicBlock basicBlock--single">
        <div class="basicBlock__content">
            <form method="POST" action="{{ route('home.paypal') }}">
                {{ csrf_field() }}
                <h2 class="basicBlock__title">Payment Form</h2>
                <p class="basicBlock__subtitle text-left">Invest in USD</p>
                <div class="formControl">
                    <label class="icoForm__label"><b>Enter Amount</b></label>
                    <input class="wallet icoForm__input icoForm__input--pencil" name="amount" type="number"></p>
                    <label class="icoForm__label"><b>Enter you ETH wallet</b></label>
                    <input class="wallet icoForm__input icoForm__input--pencil" name="wallet" type="text"></p>
                    <button class="btn btn--small">Pay with PayPal</button>
                </div>

            </form>
        </div>
    </div>
</div>
