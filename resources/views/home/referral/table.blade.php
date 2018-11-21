<div class="referral__table-wrap referral__table-wrap--active">
    <table class="referral__table">
        <tr>
            <th class="referral__cell referral__cell--person referral__cell--th">{!! trans('home/referrals.tableRef') !!}</th>
            <th class="referral__cell referral__cell--bonus referral__cell--th">{!! trans('home/referrals.tableBonus') !!}</th>
        </tr>
        @if(isset($referrals['stat']))
            @foreach($referrals['stat'] as $key => $referral)
                <tr>
                    <td class="referral__cell referral__cell--person">{{ $key }}</td>
                    <td class="referral__cell referral__cell--bonus">{{ isset($referral['token_sum']) ? $referral['token_sum'] : 0}}</td>
                </tr>
            @endforeach

        @else
            <tr>
                <td class="referral__cell referral__cell--person">No</td>
                <td class="referral__cell referral__cell--bonus">0</td>
            </tr>
        @endif
    </table>
</div>