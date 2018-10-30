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

                                {{--!!Component!!--}}
                                <history-table></history-table>
                                {{--!!Component!!--}}

                                {{--<div class="dataTable">--}}
                                    {{--<table class="dataTable__list">--}}
                                        {{--<tr>--}}
                                            {{--<th>Investor ID</th>--}}
                                            {{--<th>Action</th>--}}
                                            {{--<th>Old info</th>--}}
                                            {{--<th>New info</th>--}}
                                            {{--<th>date</th>--}}
                                        {{--</tr>--}}
                                        {{--@foreach($histories as $keyHistory => $history)--}}
                                            {{--@foreach($history as $keyAction => $action)--}}
                                                {{--<tr class="dataTable__success">--}}
                                                    {{--<td>{{ $keyHistory }}</td>--}}
                                                    {{--<td>{{ $keyAction }}</td>--}}
                                                    {{--@if($keyAction === 'reg' || $keyAction === 'change_pwd')--}}
                                                        {{--<td>{{ substr($action[1], 0, 25) }}</td>--}}
                                                        {{--<td>{{ substr($action[0], 0, 25) }}</td>--}}
                                                    {{--@else--}}
                                                        {{--<td>{{ $action[1] }}</td>--}}
                                                        {{--<td>{{ $action[0] }}</td>--}}
                                                    {{--@endif--}}
                                                    {{--<td>{{ $action[2] }}</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                        {{--@endforeach--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection