@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        @if(!Auth::user()->confirmed)
            <div class="messageTop">
                <p class="messageTop__text"></p>
            </div>
        @endif
        <div class="scrollHolder">
            <div class="content" id="buyTokens">
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock">
                            <div class="basicBlock__content">
                                <div class="basicBlock__text">{!! trans('home/referrals.refText') !!}
                                </div>
                                <div class="basicBlock__bonusText">{!! trans('home/referrals.refBonus') !!} 5.00%</div>

                            </div>
                        </div>
                    </div>
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock">
                            <div class="basicBlock__content">
                                <form class="loginForm icoForm" action="#">
                                    @if(Auth::user()->wallets()->first())
                                        <div class="basicBlock__text"> Your referral link</div>
                                        <div class="formControl">
                                            <input class="icoForm__input icoForm__input--canCopy" type="text"
                                                   value="{{url('/').'/?ref='.Auth::user()->token}}" name="ethWallet"
                                                   id="ethWallet"><span class="icoForm__copy"
                                                                        v-on:click="copyToBuffer"> </span>
                                        </div>
                                    @else
                                        <h4 class="referral__message">To participate in the referral program, add a wallet</h4>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->wallets()->first())
                <div class="referral__table-wrap referral__table-wrap--active">
                    <table class="referral__table">
                        <tr>
                            <th class="referral__cell referral__cell--person referral__cell--th">Reffered person</th>
                            <th class="referral__cell referral__cell--bonus referral__cell--th">Bonus</th>
                        </tr>
                        @if(isset($referrals['stat']))
                            @foreach($referrals['stat'] as $key => $referral)
                                <tr>
                                    <td class="referral__cell referral__cell--person">{{ $key }}</td>
                                    <td class="referral__cell referral__cell--bonus">{{ $referral['token_sum'] }}</td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td class="referral__cell referral__cell--person">No</td>
                                <td class="referral__cell referral__cell--bonus">0</td>
                            </tr>
                        @endif
                    </table>
                </div>
            @else

            @endif
        </div>
    </div>
    @push('scripts')
        @include('_js.js_copy_to_clipboard')
    @endpush
@endsection

