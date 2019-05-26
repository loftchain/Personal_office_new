<?php

return [
    'refText' => 'Referral bonus of 10% (paid in '. env('TOKEN_NAME') .')
    is awarded to the owner of referral link and is
    based on the number of '. env('TOKEN_NAME') .' Tokens successfully
    purchased using that referral link.',
    'refBonus' => 'Referral bonus:',

    //table
    'tableRef' => 'Referred person',
    'tableBonus' => 'Bonus',
    'tableNoReferrals' => 'No referrals',
    'tableNoWallet' => 'To participate in the referral program, make your first transaction',
    'minPurchase' => 'Minimum purchase is 25 '. env('TOKEN_NAME') .' Tokens',

    'refLink' => 'Your referral link',

];
