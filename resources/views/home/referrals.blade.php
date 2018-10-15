@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="messageTop">Unfortunately your profile is not verified yet.</div>
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
                                <div class="dataTable">
                                    <table class="dataTable__list">
                                        <tr>
                                            <th>Referred person</th>
                                            <th>Bonus</th>
                                        </tr>
                                        @if(isset($referrals['stat']))
                                            @foreach($referrals['stat'] as $key => $referral)
                                                <tr class="dataTable__success">
                                                    <td>{{ $key }}</td>
                                                    <td>{{ $referral['token_sum'] }}</td>
                                                </tr>
                                                {{--<tr class="dataTable__success">--}}
                                                {{--<td>jhfcsaiudgfcubryc7b467b32a5x6b4q2</td>--}}
                                                {{--<td>+230 ETH</td>--}}
                                                {{--</tr>--}}
                                            @endforeach

                                        @else
                                            <tr class="dataTable__error">
                                                <td colspan="2"><h3>No referrals</h3></td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
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
        </div>
    </div>
@endsection