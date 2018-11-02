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
                <div class="blockHolder">
                    <div class="raisedContainer">
                        <div class="basicBlock">
                            <div class="basicBlock__content">
                                <div class="basicBlock__text">{!! trans('home/referrals.refText') !!}
                                </div>
                                <div class="basicBlock__bonusText">{!! trans('home/referrals.refBonus') !!} 10%</div>

                            </div>
                        </div>
                    </div>
                    <div class="raisedContainer">
                        <div class="basicBlock basicBlock">
                            <div class="basicBlock__content">
                                @include('home.referral.link')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->wallets()->first())
                @include('home.referral.table')
            @else

            @endif
        </div>
    </div>
    @push('scripts')
        @include('_js.js_copy_to_clipboard')
    @endpush
@endsection

