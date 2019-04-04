<div class="raisedContainer">
    <div class="basicBlock basicBlock--single">
        <div class="basicBlock__content">
            <div class="basicBlock__title text-center">{!! trans('home/buyTokens.trans') !!}</div>
            <div class="basicBlock__subtitle text-center">{!! trans('home/buyTokens.transText') !!}</div>
            <div class="dataTable">
                <table class="dataTable__list">
                    <tr>
                        <th>{!! trans('home/buyTokens.tableTransDate') !!}</th>
                        <th>{!! trans('home/buyTokens.tableTransCurrency') !!}</th>
                        <th>{!! trans('home/buyTokens.tableTransAmount') !!}</th>
                        <th>{!! trans('home/buyTokens.tableTransStatus') !!}</th>
                        <th>{!! trans('home/buyTokens.tableAction') !!}</th>
                    </tr>
                    @forelse($transactions as $transaction)
                        <tr class="{{ $transaction->status == 'true' ? "dataTable__success" : 'dataTable__error' }} tr-tx-table">
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->currency }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->status === 'true' ? 'success' : 'fail' }}</td>
                            <td>
                                <i class="up-btn trans-{{ $transaction->id }} fa fa-chevron-up" dataid="{{ $transaction->id }}" style="cursor: pointer"></i>
                                <i class="dn-btn trans-{{ $transaction->id }} fa fa-chevron-down" dataid="{{ $transaction->id }}" style="display: none; cursor: pointer"></i>
                            </td>
                        </tr>
                        <tr class="dataTable__summary" id="data-{{ $transaction->id }}" style="display: none">
                            <td colspan="3"><span class="dataTable__address"><strong>{!! trans('home/buyTokens.tableSumTo') !!}</strong>: {{ $transaction->from }}</span></td>
                            <td colspan="3"><strong>{!! trans('home/buyTokens.tableSumInfo') !!}: </strong><a class="dataTable__link" href="https://{{ $transaction->info }}/tx/{{ $transaction->transaction_id }}" target="_blank">{{ $transaction->info }}</a></td>
                        </tr>
                    @empty
                        <tr class="dataTable__error">
                            <td colspan="6"><h3>{!! trans('home/buyTokens.tableNoTrans') !!}</h3></td>
                        </tr>
                    @endforelse

                </table>
            </div>
        </div>
    </div>
</div>
