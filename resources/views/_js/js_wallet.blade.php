<script>
    let wallet = {
        btn: $('.cryptoSelector__item'),
        bEth: $('#buttonEth'),
        bBtc: $('#buttonBtc'),
        bPay: $('#buttonPay'),
        fEth: $('#formEth'),
        fBtc: $('#formBtc'),
        fPay: $('#formPay'),
        dQr: $('#qr'),
        block: $('.blockHolder--token'),
        walBlock: $('.raisedContainer--wallet'),
        qrBlock: $('.raisedContainer--qr'),
        blockEth: $('#blockEth'),
        blockBtc: $('#blockBtc'),
        blockFake: $('#blockFake'),
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
                            $('.raisedContainer--qr-2').removeClass('raisedContainer--disabled');
                        }
                        break;
                    default:
                        if (type.val() === wallet.type) {

                            if (wallet.type === 'from_to') {
                                _this.val(wallet_val);
                                $('.raisedContainer--qr-1').removeClass('raisedContainer--disabled');
                            }

                            if (wallet.type === 'to') {
                                _this.val(wallet_val);
                                $('.raisedContainer--qr-2').removeClass('raisedContainer--disabled');
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
          wallet.btn.removeClass('cryptoSelector__item--active');
          wallet.block.addClass('blockHolder--hide');
          wallet.wInput.removeAttr('disabled');
          wallet.walBlock.removeClass('raisedContainer--disabled');
        }
    };

    $(document).ready(() => {
        wallet.wInput.each(function () {
            wallet.setWallets($(this));
        });

        wallet.isPersonal();
    });

    wallet.bEth.click((evt) => {
        wallet.removeDisabled(this);
        $(evt.target).addClass('cryptoSelector__item--active');
        wallet.blockEth.removeClass('blockHolder--hide');
        // wallet.fBtc.hide();
        // wallet.fEth.show();
        // wallet.qrBtc.hide();
        // wallet.qrEth.show();
    });

    wallet.bBtc.click((evt) => {
        wallet.removeDisabled(this);
        $(evt.target).addClass('cryptoSelector__item--active');
        wallet.blockBtc.removeClass('blockHolder--hide');
        // wallet.fEth.hide();
        // wallet.fBtc.show();
        // wallet.qrEth.hide();
        // wallet.qrBtc.show();
    });

    wallet.bPay.click(() => {
       wallet.bPay.addClass('cryptoSelector__item--active');
       wallet.bEth.removeClass('cryptoSelector__item--active');
       wallet.bBtc.removeClass('cryptoSelector__item--active');
        wallet.fEth.hide();
        wallet.fBtc.hide();
        wallet.dQr.hide();
        wallet.fPay.show();
        wallet.qrEth.hide();
        wallet.qrBtc.hide();
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