@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="scrollHolder">
            <div class="content" id="buyTokens">
                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--full basicBlock--settings">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="dataTable">
                                    <table class="dataTable__list">
                                        <tr>
                                            <th>Investor ID</th>
                                            <th>email</th>
                                            <th>wallet</th>
                                            <th>tokens</th>
                                        </tr>
                                        @foreach($referrals as $referral)
                                                <tr class="dataTable__success">
                                                    <td>{{ $referral->investor_id }}</td>
                                                    <td>{{ $referral->investor->email }}</td>
                                                    <td>{{ $referral->wallet_to }}</td>
                                                    <td>{{ $referral->tokens }}</td>
                                                </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection