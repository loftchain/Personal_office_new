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
                                <div class="basicBlock__text">{!! trans('home/referrals.refText') !!}
                                </div>
                                <div class="basicBlock__bonusText">{!! trans('home/referrals.refBonus') !!} 5.00%</div>
                                @if(Auth::user()->wallets()->first())
                                <div class="dataTable">
                                    <table class="dataTable__list">
                                        <tr>
                                            <th>{!! trans('home/referrals.tableRef') !!}</th>
                                            <th>{!! trans('home/referrals.tableBonus') !!}</th>
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
                                                <td colspan="2"><h3>{!! trans('home/referrals.tableNoReferrals') !!}</h3></td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                    @else
                                <h4>{!! trans('home/referrals.tableNoWallet') !!}</h4>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock">
                            <div class="basicBlock__content">
                                <form class="loginForm icoForm" action="#">
                                    <div class="basicBlock__text"> {!! trans('home/referrals.refLink') !!}</div>
                                    <div class="formControl">
                                        <input class="icoForm__input icoForm__input--canCopy" type="text"
                                               value="{{url('/').'/?ref=' . Auth::user()->token}}" name="ethWallet"
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