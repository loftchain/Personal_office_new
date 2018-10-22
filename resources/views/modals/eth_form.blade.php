<form action="{{ route('home.tokens.store') }}" method="post">
    {{ csrf_field() }}
    <div class="formControl">
        <input type="hidden" name="type" class="type" value="from_to">
        <input type="hidden" name="currency" class="currency" value="ETH">
        <label class="icoForm__label">ETH wallet  for investing and receiving tokens</label>
        <input id="wallet" data-currency="ETH" class="wallet icoForm__input icoForm__input--pencil" type="text" name="wallet" required>
        <span class="icoForm__pencil"></span>
    </div>
    <div class="error-message wallet"></div>
</form>