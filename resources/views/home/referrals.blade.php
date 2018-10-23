@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        @if(!Auth::user()->confirmed)
            <div class="messageTop">Unfortunately your profile is not verified yet.</div>
        @endif
        <div class="scrollHolder">
            <div class="content" id="buyTokens">
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock">
                            <div class="basicBlock__content">
                                <div class="basicBlock__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                    veniam, quis nostrud exercitation ullamco laboris
                                </div>
                                <div class="basicBlock__bonusText">Referral bonus: 5.00%</div>

                            </div>
                        </div>
                    </div>
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock">
                            <div class="basicBlock__content">
                                <form class="loginForm icoForm" action="#">
                                    <div class="basicBlock__text"> Your referral link</div>
                                    <div class="formControl">
                                        <input class="icoForm__input icoForm__input--canCopy" type="text"
                                               value="{{url('/').'/?ref='.Auth::user()->token}}" name="ethWallet"
                                               id="ethWallet"><span class="icoForm__copy"
                                                                    v-on:click="copyToBuffer"> </span>
                                    </div>
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
                                <td class="referral__cell referral__cell--no-referral">No referrals</td>
                            </tr>
                        @endif
                    </table>
                </div>
            @else
                <h4 class="referral__message">To participate in the referral program, add a wallet</h4>
            @endif
            {{--<div class="referral__table-wrap referral__table-wrap--active">--}}
                {{--<table class="referral__table">--}}
                    {{--<tr>--}}
                        {{--<th class="referral__cell referral__cell--person referral__cell--th">Reffered person</th>--}}
                        {{--<th class="referral__cell referral__cell--bonus referral__cell--th">Bonus</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="referral__cell referral__cell--person">jhfcsaiudgfcubryc7b467b32a5x6b4q2</td>--}}
                        {{--<td class="referral__cell referral__cell--bonus">+230 ETH</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="referral__cell referral__cell--person">jhfcsaiudgfcubryc7b467b32a5x6b4q2</td>--}}
                        {{--<td class="referral__cell referral__cell--bonus">+230 ETH</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection