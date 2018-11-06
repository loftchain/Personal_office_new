<script>
    let v = {
        form: $('form'),
        xInput: $('.icoForm__input'),
        errors: $('.error-message'),
        loaderSpinner: $('.small-spinner'),
        modal: $('.modal'),
        modalBtn: $('.modal-btn'),
        grayBorderColor: '#E0E0E0',
        exclamation: '<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp',
        bg: {
            success: '#6fe86f',
            danger: '#f03535',
            warning: 'linear-gradient(90deg, #FFC701 0%, #FFE13A 100%)',
            normal: '#ffffff'
        },
        userConfirmed: '{{ Auth::user() ? Auth::user()->confirmed : null }}',

        resetModal: () => {
            v.xInput.removeClass('isError');
            v.errors.text('');
        },

        closeModal: () => {
            v.modal.modal('hide');
            $('.modal-backdrop').remove();
        },

        // showNotification: (text, type) => {
        //     $.notify(text, {
        //         type: type
        //     });
        // },

        showMessage(text, bgColor) {
            let message = $('.messageTop');
            let messageText = $('.messageTop__text');
            messageText.text(text);
            message.append('<button class="messageTop__button"><span></span></button>');
            message.css('background', bgColor);

            let closeButton = $('.messageTop__button');
            closeButton.click(function() {
                if (v.userConfirmed == 0) {
                  messageText.text('Unfortunately your profile is not verified yet.');
                  message.css('background', v.bg.warning);
                }   else {
                  messageText.text('');
                  message.css('background', v.bg.normal);
                }
                $(this).remove();
            });

        },

        hideSpinner: () => {
            v.loaderSpinner.fadeOut();
        },

        stateSelection: (data, _this) => {
            switch (true) {
                case !$.isEmptyObject(data.validation_error):
                    if (data.validation_error['g-recaptcha-response']) {
                        data.validation_error['g-recaptcha-response'] = ['{!! trans('validation.accepted') !!}'];
                    }

                    $.each(data.validation_error, (key, value) => {
                        if(window.location.href == '{{ route('home.kyc') }}') {
                            _this.children('.row').children().find('.error-message.' + key).prev().children('input').attr('style', 'border: 2px solid #FF0000;');
                            _this.children('.row').children().find('.error-message.' + key).addClass('isError')
                            _this.children('.row').children().find('.error-message.' + key).html(v.exclamation + value[0]);
                            console.log(_this.children('.row').children().find('.error-message.' + key).prev().children('input'))

                        }
                        // if (_this.children('.error-message.' + key).prev().hasClass('x-input')) {
                        //     _this.children('.error-message.' + key).prev().addClass('isError');
                        // }
                        if (_this.children('.error-message.' + key).prev().children().hasClass('icoForm__input')) {
                            _this.children('.error-message.' + key).prev().children('input').attr('style', 'border: 2px solid #FF0000;')
                            _this.children('.error-message.' + key).addClass('isError')
                        }
                        _this.children('.error-message.' + key).html(v.exclamation + value[0]);

                        // if (_this.children().children('.error-message.' + key).prev().hasClass('x-input')) {
                        //     _this.children().children('.error-message.' + key).prev().addClass('isError');
                        // }
                        // _this.children().children('.error-message.' + key).html(v.exclamation + value[0]);
                    });
                    v.hideSpinner();
                    break;
                case !$.isEmptyObject(data.not_your_email):
                case !$.isEmptyObject(data.not_equal):
                case !$.isEmptyObject(data.pwd_not_match):
                case !$.isEmptyObject(data.is_taken):
                case !$.isEmptyObject(data.failed):
                case !$.isEmptyObject(data.reg_limit_exceeded):
                case !$.isEmptyObject(data.reset_limit_exceeded):
                case !$.isEmptyObject(data.not_confirmed):
                case !$.isEmptyObject(data.invalid_post_service):
                case !$.isEmptyObject(data.smth_went_wrong):
                case !$.isEmptyObject(data.user_not_found):
                case !$.isEmptyObject(data.invalid_send_mail):
                case !$.isEmptyObject(data.invalid_send_reset_mail):
                case !$.isEmptyObject(data.reset_email_not_match):
                case !$.isEmptyObject(data.no_such_user):
                case !$.isEmptyObject(data.already_confirmed):
                case !$.isEmptyObject(data.already_exists):
                    $.each(data, (key, value) => {
                        _this.children('.error-message.' + key).prev().children('input').attr('style', 'border: 2px solid #FF0000;');
                        _this.children('.error-message.' + key).html(v.exclamation + value).addClass('isError');
                    });
                    v.hideSpinner();
                    break;
                case !$.isEmptyObject(data.success_register):
                    window.location.replace("{{ route('home.index') }}");
                    break;
                case !$.isEmptyObject(data.success_login):
                    window.location.replace("{{ route('root') . '/home' }}");
                    localStorage.setItem('success_login', '+');
                    break;
                case !$.isEmptyObject(data.success_reset_email_sent):
                    window.location.replace("/");
                    {{--v.showMessage('{!! trans('auth/resetPwd.letterSent_js') !!}', v.bg.success);--}}
                    {{--v.showNotification('{!! trans('auth/resetPwd.letterSent_js') !!}', 'success');--}}
                    v.closeModal();
                    break;
                case !$.isEmptyObject(data.error_reset_email_sent):
                    v.showMessage('{!! trans('auth/resetPwd.letterSentError_js') !!}', v.bg.danger);
                    {{--v.showNotification('{!! trans('auth/resetPwd.letterSentError_js') !!}', 'danger');--}}
                    v.closeModal();
                    break;
                case !$.isEmptyObject(data.success_reset_pwd):
                    window.location.replace("{{ route('root') . '/home' }}");
                    localStorage.setItem('success_reset_pwd', '+');
                    break;
                case !$.isEmptyObject(data.success_changed_email):
                    _this.find('.icoForm__input').val('');
                    v.closeModal();
                    v.showMessage('{!! trans('modals/modals.emailChanged_js') !!}', v.bg.success);
                    {{--v.showNotification('{!! trans('modals/modals.emailChanged_js') !!}', 'success');--}}
                    break;
                case !$.isEmptyObject(data.success_changed_pwd):
                    _this.find('.icoForm__input').val('');
                    v.closeModal();
                    v.showMessage('{!! trans('modals/modals.pwdChanged_js') !!}', v.bg.success);
                    {{--v.showNotification('{!! trans('modals/modals.pwdChanged_js') !!}', 'success');--}}
                    break;
                case !$.isEmptyObject(data.goto2):
                    window.location.replace("{{ route('root') }}");
                    break;
                case !$.isEmptyObject(data.wallet):
                    console.log('test error')
                    break;
                case !$.isEmptyObject(data.wallet_added):
                    v.showMessage('{!! trans('home/buyTokens.walletAdded') !!}', v.bg.success);
                    $('#fakeTable').show();
                    {{--v.showNotification('{!! trans('home/wallet.added_js') !!}', 'success');--}}
                    if (typeof wallet !== 'undefined') {
                        // wa.exitEditMode(_this.children('.w-input'));
                        // if(_this.children('.formControl').children('.type').val() === 'to' && $('#wallet1').val() > 0){
                        //     // wa.showDescription('BTC');
                        // }
                        //
                        // if(_this.children('.formControl').children('.type').val() === 'from' && $('#wallet2').val() > 0){
                        //     // wa.showDescription(data.currency);
                        // }

                        if(_this.children('.formControl').children('.type').val() === 'from_to'){
                            // wa.showDescription(data.currency);
                          $('.raisedContainer--qr-1').removeClass('raisedContainer--disabled');
                        }
                        if((_this.children('.formControl').children('.type').val() === 'to' || _this.children('.formControl').children('.type').val() === 'from') && $('#wallet1').val() != '' && $('#wallet2').val() != '') {
                          $('.raisedContainer--qr-2').removeClass('raisedContainer--disabled');
                        }

                    }
                    break;
                case !$.isEmptyObject(data.usd_request_sent):
                    v.showMessage('{!! trans('home/wallet.requestWasSent_js') !!}', v.bg.success);
                    {{--v.showNotification('{!! trans('home/wallet.requestWasSent_js') !!}', 'success');--}}
                    v.hideSpinner();
                    break;
                case !$.isEmptyObject(data.wallet_edited):
                    v.showMessage('{!! trans('home/wallet.edited_js') !!}', v.bg.success);
                    {{--v.showNotification('{!! trans('home/wallet.edited_js') !!}', 'success');--}}
                    if (typeof wa !== 'undefined') {
                        wa.exitEditMode(_this.children('.w-input'));
                    }
                    break;
                case !$.isEmptyObject(data.confirmation_complete):
                    v.showMessage('{!! trans('admin/confirmation.userConfirmed_js') !!}', v.bg.success);
                    {{--v.showNotification('{!! trans('admin/confirmation.userConfirmed_js') !!}', 'success');--}}
                    break;
                case data.kyc_success:
                    $('#divContent').hide();
                    $('#fakeConfirmed').show();
                    $('#agreement').attr('disabled', true);
                    break;
                default:
                    console.log('js_custom_validation.blade.php default switch state');
                    break;
            }
        },

        validate(_this) {
            let ethRegExp = new RegExp("^0x[a-fA-F0-9]{40}$");
            let btcRegExp = new RegExp("^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$");

            switch (_this.data('currency')) {
                case 'ETH':
                    if (ethRegExp.test(_this.val())) {
                        return true
                    } else {
                        _this.val('');
                    }
                    break;
                case 'BTC':
                    if (btcRegExp.test(_this.val())) {
                        return true
                    } else {
                        _this.val('');
                    }
                    break;
            }
        },

        ajax_form: function () {
                $(this).on('submit', function (e) {
                    let isWallet = typeof wallet !== 'undefined' ? !wallet.bPay.hasClass('cryptoSelector__item--active') : true;
                    if(isWallet) {
                        e.preventDefault();
                        v.resetModal();
                        $.ajax({
                            url: $(this).attr('action'),
                            type: $(this).attr('method'),
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: data => {
                                console.log(data.kyc_success);
                                // v.loaderSpinner.hide();
                                v.stateSelection(data, $(this));
                            },

                            error: data => {
                                console.log('Error: Something wrong with ajax call ' + data.errors);
                            }
                        });
                    }
                });

        }
    };

    v.xInput.on('input', function () {
        if ($(this).is(':valid')) {
            $(this).removeAttr('style');
            $(this).parent().next().html('');

            if ($(this).hasClass('wallet')) {
                v.validate($(this));
            }
        }

    });

    v.form.each(v.ajax_form);

    $(document).ready(() => {
      let message = $('.messageTop');
      let messageText = $('.messageTop__text');
      if (v.userConfirmed == 0) {
        messageText.text('{!! trans('layouts/message.messageTop') !!}');
        message.css('background', v.bg.warning);
      }   else {
        messageText.text('');
        message.css('background', v.bg.normal);
      }
    });
</script>
