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
                    <br>
                    <label class="icoForm__label"><b>{!! trans('home/buyTokens.formPayPal_enterEth') !!}</b></label>
                    <input id="payPalWallet" data-currency="ETH" class="wallet icoForm__input icoForm__input--pencil" name="wallet" type="text" value="{{ $walletTo ? $walletTo->wallet : '' }}">
                    <div class="message-error wallet"></div>
                    </p>
                    {{--<button class="btn btn--small">{!! trans('home/buyTokens.formPayPal_Btn') !!}</button>--}}
                    <div id="paypal-button"></div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            env: '{{ env('APP_ENV') !== 'local' ? 'production' : 'sandbox' }}',

            locale: 'en_US',
            style: {
                layout: 'horizontal',
                size: 'medium',
                color: 'gold',
                shape: 'pill',
            },

            payment: function(data, actions) {
                return actions.request.post('{{ route('home.paypal') }}', {_token: '{{ csrf_token() }}',wallet: $('#payPalWallet').val(), amount: $('#payPalAmount').val()})
                    .then(function(res) {
                        return res.id;
                    })
                    .catch((res) => {
                        v.showMessage('Check the correct data entry!', v.bg.danger)
                    });
            },

            onAuthorize: function(data, actions) {
                return actions.request.post('{{ route('home.paypal.execute') }}', {
                    _token: '{{ csrf_token() }}',
                    paymentID: data.paymentID,
                    payerID:   data.payerID
                })
                    .then(function(res) {
                        if (res.status) {
                            $('#payPalWallet').val('');
                            $('#payPalAmount').val('');
                            v.showMessage('Payment was successful!', v.bg.success)
                        } else {
                            v.showMessage('Error, try again!', v.bg.danger)
                        }
                    }).catch((res) => {
                        console.log('Error' . res)
                    });
            }
        }, '#paypal-button');
    </script>
@endpush
