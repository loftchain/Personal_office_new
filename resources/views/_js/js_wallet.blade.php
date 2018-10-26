<script>
    let wallet = {
        bEth: $('#buttonEth'),
        bBtc: $('#buttonBtc'),
        fEth: $('#formEth'),
        fBtc: $('#formBtc'),
        qrEth: $('#qrEth'),
        qrBtc: $('#qrBtc'),
        wInput: $('.wallet'),
        personal: '{{ $personal }}',

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
                            $('.raisedContainer--disabled').removeClass('raisedContainer--disabled');
                        }
                        break;
                    default:
                        if (type.val() === wallet.type) {

                            if (wallet.type === 'from_to') {
                                _this.val(wallet_val);
                                $('.raisedContainer--disabled').removeClass('raisedContainer--disabled');
                            }

                            if (wallet.type === 'to') {
                                _this.val(wallet_val);
                                $('.raisedContainer--disabled').removeClass('raisedContainer--disabled');
                            }

                        }
                        break;
                }
            });
        },

        isPersonal() {
            let personal = wallet.personal,
                input = wallet.wInput;

            if(!personal) {
                input.attr('disabled', true);
                // $('#formWallets').attr('style', 'background-color: whitesmoke');
                // $('#formQr').attr('style', 'background-color: whitesmoke');
            }
        },

        removeDisabled() {
          $('.raisedContainer--wallet').addClass('raisedContainer--disabled');
          $('.raisedContainer--disabled').eq(0).removeClass('raisedContainer--disabled');
          wallet.wInput.removeAttr('disabled');
        }
    };

    $(document).ready(() => {
        wallet.wInput.each(function () {
            wallet.setWallets($(this));
        });

        wallet.isPersonal();
    });

    wallet.bEth.click(() => {
        wallet.bEth.addClass('cryptoSelector__item--active');
        wallet.bBtc.removeClass('cryptoSelector__item--active');
        wallet.fBtc.hide();
        wallet.fEth.show();
        wallet.qrBtc.hide();
        wallet.qrEth.show();
        wallet.removeDisabled();
    });

    wallet.bBtc.click(() => {
        wallet.bBtc.addClass('cryptoSelector__item--active');
        wallet.bEth.removeClass('cryptoSelector__item--active');
        wallet.fEth.hide();
        wallet.fBtc.show();
        wallet.qrEth.hide();
        wallet.qrBtc.show();
        wallet.removeDisabled();
    });

    wallet.wInput.on('input', function() {
      if ($(this).is(':valid')) {
        $(this).next().removeClass('icoForm__pencil--disabled');
      } else {
        $(this).next().addClass('icoForm__pencil--disabled');
      }
    });


</script>