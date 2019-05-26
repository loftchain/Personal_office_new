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
        blockPay: $('#blockPay'),
        blockFake: $('#blockFake'),
        qrEth: $('#qrEth'),
        qrBtc: $('#qrBtc'),
        wInput: $('.wallet'),
        personal: '{{ $personal }}',
        confirmed: '{{ Auth::user()->confirmed }}',
        wallet: false,

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
                if ($('#wallet1').val() != '' && $('#wallet2').val() != '') {
                    $('.raisedContainer--qr-2').removeClass('raisedContainer--disabled');
                }
                switch (wallet.type) {
                    case 'from':
                        if (currency.val() === wallet.currency) {
                            _this.val(wallet_val);
                            _this.attr('disabled', true)
                            // $('.raisedContainer--qr-2').removeClass('raisedContainer--disabled');
                        }
                        break;
                    default:
                        if (type.val() === wallet.type) {

                            if (wallet.type === 'from_to') {
                                _this.val(wallet_val);
                                _this.attr('disabled', true);
                                $('.raisedContainer--qr-1').removeClass('raisedContainer--disabled');
                            }

                            if (wallet.type === 'to') {
                                _this.val(wallet_val);
                                _this.attr('disabled', true);
                                $('#wallet2').removeAttr('disabled');
                                // $('.raisedContainer--qr-2').removeClass('raisedContainer--disabled');
                            }

                        }
                        break;
                }
            });
        },

        isConfirmed() {
            let confirmed = wallet.confirmed;

            if (confirmed == 0) {
                wallet.bEth.attr('disabled', true);
                wallet.bBtc.attr('disabled', true);
                wallet.bPay.attr('disabled', true);
            }
        },

        removeDisabled() {
            wallet.btn.removeClass('cryptoSelector__item--active');
            wallet.block.addClass('blockHolder--hide');
            // wallet.wInput.removeAttr('disabled');
            wallet.walBlock.removeClass('raisedContainer--disabled');
        }
    };

    $(document).ready(() => {
        wallet.wInput.each(function () {
            wallet.setWallets($(this));
        });

        wallet.isConfirmed();
    });

    wallet.bEth.click((evt) => {
        wallet.removeDisabled(this);
        $(evt.target).addClass('cryptoSelector__item--active');
        wallet.blockEth.removeClass('blockHolder--hide');
        $('#txTable').show();

        if (wallet.wallet) {
            $('#fakeTable').show();
        }
    });

    wallet.bBtc.click((evt) => {
        wallet.removeDisabled(this);
        $(evt.target).addClass('cryptoSelector__item--active');
        wallet.blockBtc.removeClass('blockHolder--hide');
        $('#txTable').show();

        if (wallet.wallet) {
            $('#fakeTable').show();
        }
    });

    wallet.bPay.click((evt) => {
        wallet.removeDisabled(this);
        $(evt.target).addClass('cryptoSelector__item--active');
        wallet.blockPay.removeClass('blockHolder--hide');
        $('#txTable').hide();

        if (wallet.wallet) {
            $('#fakeTable').hide();
        }
    });

    wallet.wInput.on('input', function () {
        if ($(this).is(':valid')) {
            $(this).next().removeClass('icoForm__pencil--disabled');
        } else {
            $(this).next().addClass('icoForm__pencil--disabled');
        }
    });

    $('#payPalAmount').on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });


</script>
