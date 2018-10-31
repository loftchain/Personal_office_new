@extends('layouts.app')

@section('content')

    <div  class="workArea jsWorkArea">

        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="scrollHolder">

            <div class="content">
                <div class="blockHolder">
                    <div class="raisedContainer raisedContainer--full basicBlock--settings">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <verification-table></verification-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
