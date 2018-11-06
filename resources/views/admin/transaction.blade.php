@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="scrollHolder">
            <div class="content">
                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--full basicBlock--settings">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <tx-table></tx-table>

                                <div class="dataTable">
                                    <table class="dataTable__list">
                                        <tr>
                                            <th>Investor ID</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                            <th>Amount Tokens</th>
                                            <th>Status</th>
                                            <th>From/To</th>
                                            <th>Date</th>
                                            <th>Info</th>
                                        </tr>
                                        @foreach($transactions as $transaction)
                                            <tr class="dataTable__success">
                                                <td>{{ $transaction->investor_id }}</td>
                                                <td>{{ $transaction->currency }}</td>
                                                <td>{{ $transaction->amount }}</td>
                                                <td>{{ $transaction->amount_tokens }}</td>
                                                <td>{{ $transaction->status }}</td>
                                                <td>{{ $transaction->from }}</td>
                                                <td>{{ $transaction->date }}</td>
                                                <td>info</td>
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
