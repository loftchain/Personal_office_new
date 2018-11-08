<div class="raisedContainer">
    <div class="basicBlock basicBlock--single">
        <div class="basicBlock__content">
            <div class="basicBlock__title text-center">{!! trans('home/buyTokens.trans') !!}</div>
            <div class="basicBlock__subtitle text-center">{!! trans('home/buyTokens.transText') !!}</div>
            <div class="infoBtn"><a class="btn btn--small" href="#">h5723882302832cn8399c2</a></div>
            <div class="dataTable">
                <table class="dataTable__list">
                    <tr>
                        <th>{!! trans('home/buyTokens.tableTransDate') !!}</th>
                        <th>{!! trans('home/buyTokens.tableTransCurrency') !!}</th>
                        <th>{!! trans('home/buyTokens.tableTransToken') !!}</th>
                        <th>{!! trans('home/buyTokens.tableTransStatus') !!}</th>
                        <th>Action</th>
                    </tr>
                    @forelse($transactions as $transaction)
                        <tr class="{{ $transaction->status == 'true' ? "dataTable__success" : 'dataTable__error' }}">
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->amount_tokens }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>
                                <i class="up-btn trans-{{ $transaction->id }} fa fa-chevron-up" dataid="{{ $transaction->id }}" style="cursor: pointer"></i>
                                <i class="dn-btn trans-{{ $transaction->id }} fa fa-chevron-down" dataid="{{ $transaction->id }}" style="display: none; cursor: pointer"></i>
                            </td>
                        </tr>
                        <tr class="dataTable__summary" id="data-{{ $transaction->id }}" style="display: none">
                            <td colspan="3"><span class="dataTable__address"><strong>{!! trans('home/buyTokens.tableSumTo') !!}</strong>: {{ $transaction->from }}</span></td>
                            <td colspan="2"><strong>{!! trans('home/buyTokens.tableSumInfo') !!}: </strong><a class="dataTable__link" href="#">{{ $transaction->info }}</a></td>
                        </tr>
                    @empty
                        <tr class="dataTable__error">
                            <td colspan="5"><h3>{!! trans('home/buyTokens.tableNoTrans') !!}</h3></td>
                        </tr>
                    @endforelse

                </table>
            </div>
        </div>
    </div>
</div>