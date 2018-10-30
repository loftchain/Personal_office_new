<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'unique_wallet'        => 'このウォレットはすでに使用されています',
    'unique_wallet_update' => 'このウォレットはすでに使用されています',
    'accepted'             => 'ザ :attribute 受け入れなければならない.',
    'active_url'           => 'ザ :attribute は有効なURLではありません.',
    'after'                => 'ザ :attribute 後の日付でなければなりません :date.',
    'after_or_equal'       => 'ザ :attribute に等しいかそれ以下の日付でなければなりません :date.',
    'alpha'                => 'ザ :attribute 文字のみを含むことができます.',
    'alpha_dash'           => 'ザ :attribute 文字、数字、ダッシュ、アンダースコアのみを含むことができます。',
    'alpha_num'            => 'ザ :attribute 文字と数字のみを含むことができます.',
    'array'                => 'ザ :attribute 配列でなければならない.',
    'before'               => 'ザ :attribute 前の日付でなければなりません :date.',
    'before_or_equal'      => 'ザ :attribute 前後の日付でなければなりません :date.',
    'between'              => [
        'numeric' => 'ザ :attribute 間になければならない :min and :max.',
        'file'    => 'ザ :attribute 間になければならない :min and :max キロバイト.',
        'string'  => 'ザ :attribute 間になければならない :min and :max 文字.',
        'array'   => 'ザ :attribute 間になければならない :min and :max アイテム.',
    ],
    'boolean'              => 'ザ :attribute フィールドは真または偽でなければなりません.',
    'confirmed'            => 'ザ :attribute 確認が一致しません.',
    'date'                 => 'ザ :attribute 有効な日付ではありません.',
    'date_format'          => 'ザ :attribute フォーマットと一致しません :format.',
    'different'            => 'ザ :attribute そして :other 異なるものでなければならない.',
    'digits'               => 'ザ :attribute でなければなりません :digits 数字.',
    'digits_between'       => 'ザ :attribute 間になければならない :min そして :max 数字.',
    'dimensions'           => 'ザ :attribute 無効な画像サイズがあります.',
    'distinct'             => 'ザ :attribute フィールドに重複値があります.',
    'email'                => 'ザ :attribute 有効な電子メールアドレスでなければなりません.',
    'exists'               => 'ザ 選択された :attribute 無効です.',
    'file'                 => 'ザ :attribute ファイルでなければならない.',
    'filled'               => 'ザ :attribute フィールドには値が必要です.',
    'gt'                   => [
        'numeric' => 'ザ :attribute はより大きい必要があります :value.',
        'file'    => 'ザ :attribute はより大きい必要があります :value キロバイト.',
        'string'  => 'ザ :attribute はより大きい必要があります :value 文字.',
        'array'   => 'ザ :attribute 以上が必要です :value アイテム.',
    ],
    'gte'                  => [
        'numeric' => 'ザ :attribute それ以上でなければならない :value.',
        'file'    => 'ザ :attribute それ以上でなければならない :value キロバイト.',
        'string'  => 'ザ :attribute それ以上でなければならない :value 文字.',
        'array'   => 'ザ :attribute 持つ必要があります :value アイテム以上.',
    ],
    'image'                => 'ザ :attribute イメージでなければならない.',
    'in'                   => 'ザ 選択された :attribute 無効です.',
    'in_array'             => 'ザ :attribute フィールドは存在しません :other.',
    'integer'              => 'ザ :attribute 整数でなければならない.',
    'ip'                   => 'ザ :attribute 有効なIPアドレスでなければなりません.',
    'ipv4'                 => 'ザ :attribute 有効なIPv4アドレスでなければなりません.',
    'ipv6'                 => 'ザ :attribute 有効なIPv6アドレスでなければなりません.',
    'json'                 => 'ザ :attribute 有効なJSON文字列でなければなりません.',
    'lt'                   => [
        'numeric' => 'ザ :attribute は以下より小さくなければなりません :value.',
        'file'    => 'ザ :attribute は以下より小さくなければなりません :value キロバイト.',
        'string'  => 'ザ :attribute は以下より小さくなければなりません :value 文字.',
        'array'   => 'ザ :attribute より小さい必要があります :value アイテム.',
    ],
    'lte'                  => [
        'numeric' => 'ザ :attribute 以下でなければならない :value.',
        'file'    => 'ザ :attribute 以下でなければならない :value キロバイト.',
        'string'  => 'ザ :attribute 以下でなければならない :value 文字.',
        'array'   => 'ザ :attribute 以上の値を持つことはできません :value アイテム.',
    ],
    'max'                  => [
        'numeric' => 'ザ :attribute は以下より大きくてはならない :max.',
        'file'    => 'ザ :attribute は以下より大きくてはならない :max キロバイト.',
        'string'  => 'ザ :attribute は以下より大きくてはならない :max 文字.',
        'array'   => 'ザ :attribute より多くを持つことはできません :max アイテム.',
    ],
    'mimes'                => 'ザ :attribute 型のファイルでなければならない: :values.',
        'mimetypes'            => 'ザ :attribute 型のファイルでなければならない: :values.',
    'min'                  => [
        'numeric' => 'ザ :attribute 少なくとも :min.',
        'file'    => 'ザ :attribute 少なくとも :min キロバイト.',
        'string'  => 'ザ :attribute 少なくとも :min 文字.',
        'array'   => 'ザ :attribute 少なくとも持っている必要があります :min アイテム.',
    ],
    'not_in'               => 'ザ 選択された :attribute 無効です.',
    'not_regex'            => 'ザ :attribute フォーマットが無効です.',
    'numeric'              => 'ザ :attribute 数字でなければなりません.',
    'present'              => 'ザ :attribute フィールドが存在しなければならない.',
    'regex'                => 'ザ :attribute フォーマットが無効です.',
    'required'             => 'ザ :attribute フィールドは必須項目です.',
    'required_if'          => 'ザ :attribute フィールドは、 :other は :value.',
    'required_unless'      => 'ザ :attribute 次の場合は必須フィールドです :other は に :values.',
    'required_with'        => 'ザ :attribute フィールドは、 :values は プレゼント.',
    'required_with_all'    => 'ザ :attribute フィールドは、 :values は プレゼント.',
    'required_without'     => 'ザ :attribute フィールドは、 :values は 現在ではない.',
    'required_without_all' => 'ザ :attribute フィールドは、 :values 存在しています.',
    'same'                 => 'ザ :attribute そして :other 一致している必要があります.',
    'size'                 => [
        'numeric' => 'ザ :attribute でなければなりません :size.',
        'file'    => 'ザ :attribute でなければなりません :size キロバイト.',
        'string'  => 'ザ :attribute でなければなりません :size 文字.',
        'array'   => 'ザ :attribute 含まれている必要があります :size アイテム.',
    ],
    'string'               => 'ザ :attribute 文字列でなければならない.',
    'timezone'             => 'ザ :attribute 有効なゾーンでなければならない.',
    'unique'               => 'ザ :attribute すでに使用されている.',
    'uploaded'             => 'ザ :attribute アップロードに失敗しました.',
    'url'                  => 'ザ :attribute フォーマットが無効です.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
