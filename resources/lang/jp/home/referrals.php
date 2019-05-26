<?php

return [
    'refText' => '10％の紹介ボーナス（'. env('TOKEN_NAME') .'で支払われる）
     紹介リンクの所有者に授与される
     '. env('TOKEN_NAME') .'トークンの数に基づいて成功した
     その紹介リンクを使用して購入しました。',
    'refBonus' => '紹介ボーナス:',

    //table
    'tableRef' => '紹介者',
    'tableBonus' => 'ボーナス',
    'tableNoReferrals' => '紹介なし',
    'tableNoWallet' => '紹介プログラムに参加するには、最初の取引を行います',
		'minPurchase' => '最小購入は25 '. env('TOKEN_NAME') .'トークンです',

    'refLink' => 'あなたの紹介リンク',

];
