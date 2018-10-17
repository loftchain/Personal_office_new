@extends('layouts.app')

@section('content')
    <div class="workArea jsWorkArea">
        <div class="mobileMenuBtn">
            <button class="cmn-toggle-switch cmn-toggle-switch__htx"><span>toggle menu</span></button>
        </div>
        <div class="scrollHolder">
            <div class="content" id="buyTokens">
                <div class="blockHolder">
                    <div class="raisedContainer basicBlock--settings">
                        <div class="basicBlock basicBlock--single">
                            <div class="basicBlock__content">
                                <div class="dataTable">
                                    <table class="dataTable__list">
                                        <tr>
                                            <th>Photo</th>
                                            <th>Investor ID</th>
                                            <th>E-mail</th>
                                            <th>Full name</th>
                                            <th>Date or birth</th>
                                            <th>KYC</th>
                                        </tr>
                                        @forelse($investors as $investor)
                                            <tr class="dataTable__success">
                                                <td>
                                                    <img src="{{$investor->img ? asset('storage/'. $investor->img) : asset('img/avatar.png') }}"
                                                         style="max-width: 75px; max-height: 75px;"></td>
                                                <td>{{ $investor->id }}</td>
                                                <td>{{ $investor->email }}</td>
                                                <td>{{ $investor->personal->name_surname }}</td>
                                                <td>{{ $investor->personal->date_place_birth }}</td>
                                                <td>
                                                    <button class="btn">more</button>
                                                </td>
                                            <tr class="dataTable__summary">
                                                <td colspan="3"><span class="dataTable__address" style="color: {{ $investor->confirmed ? 'green' : 'red' }}">
                                                        <strong>Status: </strong>{{ $investor->confirmed ? 'Подтвержден' : 'Не подтвержден' }}
                                                    </span>
                                                </td>
                                                <td colspan="3"><strong>Action: </strong><a class="dataTable__link" href="#">
                                                        @if(!$investor->confirmed)
                                                            <a href="{{ route('admin.kyc.confirm', $investor) }}"
                                                               class="badge badge-success">Подтвердить</a>
                                                            <a href="{{ route('admin.kyc.reject', $investor) }}"
                                                               class="badge badge-danger">Отклонить</a>
                                                        @else
                                                            No action
                                                        @endif </a></td>
                                            </tr>
                                            </tr>
                                        @empty
                                            <tr class="dataTable__error">
                                                <td colspan="6"><h3>No personals</h3></td>
                                            </tr>
                                        @endforelse
                                    </table>
                                    {{ $investors->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection