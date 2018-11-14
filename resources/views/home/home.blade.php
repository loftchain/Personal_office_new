@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="messageTop">
            <p class="messageTop__text"></p>
        </div>
        <div class="scrollHolder">
            <div class="content">

                {{--if iso has not started--}}
                @if($data['stage'] === 0)
                    <div class="blockHolder">
                        @include('home.ico.widget')
                        @include('home.ico.raised')
                    </div>

                    <div class="blockHolder">
                        @include('home.ico.ico_start')
                    </div>
                @endif

                {{--if ico started--}}
                @if($data['stage'] === 1)
                    <div class="blockHolder">
                        @include('home.ico.widget')
                        @include('home.ico.raised')
                    </div>
                    @include('home.ico.round_info')
                @endif

                {{--if ico is over--}}
                @if($data['stage'] === 2)
                    @include('home.ico.end_ico')
                @endif

                @include('home.ico.bonus')
                @include('home.ico.token_distribution')
            </div>
        </div>
    </div>
@endsection
