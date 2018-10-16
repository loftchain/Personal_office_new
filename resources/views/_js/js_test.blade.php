<script>
    let wallet = {
        bEth: $('#buttonEth'),
        bBtc: $('#buttonBtc'),
        fEth: $('#formEth'),
        fBtc: $('#formBtc'),
        wInput: $('.wallet'),

        setWallets(_this) {
            $.ajax({
                url: '{{ route('home.current_wallets') }}',
                type: 'GET',
                dataType: 'json',
                success: data => {
                    wallet.setWalletsToInputs(data, _this);
                },
                error: data => {
                    wa.ajaxErrorMessage(data);
                }
            });
        },

        setWalletsToInputs(walletsData, _this) {
            const form = _this.parent();
            const currency = form.find('.currency');
            const type = form.find('.type');
            walletsData.currentWallets.forEach(function (wallet) {
                let wallet_val = ($(window).width() > 555) ? wallet.wallet : wallet.wallet.trunc(20);
                switch (wallet.type) {
                    case 'from':
                        if (currency.val() === wallet.currency) {
                            _this.val(wallet_val);
                        }
                        break;
                    default:
                        if (type.val() === wallet.type) {

                            if (wallet.type === 'from_to') {
                                _this.val(wallet_val);
                            }

                            if (wallet.type === 'to') {
                                _this.val(wallet_val);
                            }

                        }
                        break;
                }
            });
        },
    };

    $(document).ready(() => {
        wallet.wInput.each(function () {
            wallet.setWallets($(this));
        });
    });

    wallet.bEth.click(() => {
        wallet.bEth.addClass('cryptoSelector__item--active');
        wallet.bBtc.removeClass('cryptoSelector__item--active');
        wallet.fBtc.hide();
        wallet.fEth.show();

    });

    wallet.bBtc.click(() => {
        wallet.bBtc.addClass('cryptoSelector__item--active');
        wallet.bEth.removeClass('cryptoSelector__item--active');
        wallet.fEth.hide();
        wallet.fBtc.show();
    });


</script>