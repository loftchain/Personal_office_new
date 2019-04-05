<div class="referral__table-wrap referral__table-wrap--active">
    <table class="referral__table">
        <tr>
            <th class="referral__cell referral__cell--person referral__cell--th">{!! trans('home/referrals.tableRef') !!}</th>
            <th class="referral__cell referral__cell--bonus referral__cell--th">{!! trans('home/referrals.tableBonus') !!}</th>
        </tr>
        @forelse($referrals as $referral)
            <tr>
                <td class="referral__cell referral__cell--person">{{ $referral->email }}</td>
                <td class="referral__cell referral__cell--bonus">{{ $referral->referralTokens }}</td>
            </tr>
        @empty
            <tr>
                <td class="referral__cell referral__cell--person">No</td>
                <td class="referral__cell referral__cell--bonus">0</td>
            </tr>
        @endforelse
    </table>
</div>