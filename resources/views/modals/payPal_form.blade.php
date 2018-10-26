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


{{--<form action="{{ route('home.paypal') }}" method="post" target="_top">--}}
    {{--{{ csrf_field() }}--}}
    {{--<h2 class="w3-text-blue">Payment Form</h2>--}}
    {{--<input type="hidden" name="cmd" value="_s-xclick">--}}
    {{--<input type="hidden" name="hosted_button_id" value="7X8JQQTS25PUC">--}}
    {{--<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">--}}
    {{--<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">--}}
{{--</form>--}}
