<form action="{{ route('home.tokens.store') }}" method="post">
    {{ csrf_field() }}
    <div class="formControl">
        <input type="hidden" name="currency" class="currency" value="BTC">
        <input type="hidden" name="type" class="type" value="from">
        <label class="icoForm__label">{!! trans('home/buyTokens.formBtc') !!}</label>
        <input id="wallet2" data-currency="BTC"  class="wallet icoForm__input icoForm__input--pencil" type="text" name="wallet">
        <span class="icoForm__pencil"></span>
    </div>
    <div class="error-message wallet"></div>
</form>

<form action="{{ route('home.tokens.store') }}" method="post">
    {{ csrf_field() }}
    <div class="formControl">
        <input type="hidden" name="currency" class="currency" value="ETH">
        <input type="hidden" name="type" class="type" value="to">
        <label class="icoForm__label">{!! trans('home/buyTokens.formBtcEth') !!}</label>
        <input id="wallet1" data-currency="ETH" class="wallet icoForm__input icoForm__input--pencil" type="text" name="wallet">
        <span class="icoForm__pencil"></span>
    </div>
    <div class="error-message wallet"></div>
</form>
