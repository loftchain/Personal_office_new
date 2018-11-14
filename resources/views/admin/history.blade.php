@extends('layouts.app')

@section('content')
    @if(Auth::user()->admin == 1)
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
                                <history-table></history-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
