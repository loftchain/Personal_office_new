<form class="loginForm icoForm" action="#">
    @if(Auth::user()->wallets()->first())
        <div class="basicBlock__text">{!! trans('home/referrals.refLink') !!}</div>
        <div class="formControl">
            <input class="icoForm__input icoForm__input--canCopy" type="text"
                   value="{{url('/').'/register/?ref='.Auth::user()->token}}" name="ethWallet"
                   id="ethWallet"><span class="icoForm__copy"
                                        v-on:click="copyToBuffer"> </span>
        </div>
    @else
        <h4 class="referral__message">{!! trans('home/referrals.tableNoWallet') !!}</h4>
    @endif
</form>