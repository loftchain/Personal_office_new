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
    'unique_wallet'        => '這個錢包已經被拿走了',
    'unique_wallet_update' => '這個錢包已經被拿走了',
    'accepted'             => '該 :attribute 必須被接受.',
    'active_url'           => '該 :attribute 不是有效的URL.',
    'after'                => '該 :attribute 必須是之後的約會 :date.',
    'after_or_equal'       => '該 :attribute 必須是等於或等於的日期 :date.',
    'alpha'                => '該 :attribute 可能只包含字母.',
    'alpha_dash'           => '該 :attribute 可能只包含字母，數字，短劃線和下劃線.',
    'alpha_num'            => '該 :attribute 可能只包含字母和數字.',
    'array'                => '該 :attribute 必須是一個數組.',
    'before'               => '該 :attribute 必須是之前的約會 :date.',
    'before_or_equal'      => '該 :attribute 必須是之前或之前的日期 :date.',
    'between'              => [
        'numeric' => '該 :attribute 必須在之間 :min 和 :max.',
        'file'    => '該 :attribute 必須在之間 :min 和 :max 千字節.',
        'string'  => '該 :attribute 必須在之間 :min 和 :max 人物.',
        'array'   => '該 :attribute 必須介於 :min 和 :max 項目.',
    ],
    'boolean'              => '該 :attribute 字段必須是真或假.',
    'confirmed'            => '該 :attribute 確認不符合.',
    'date'                 => '該 :attribute 不是有效日期.',
    'date_format'          => '該 :attribute 與格式不匹配 :format.',
    'different'            => '該 :attribute 和 :other 必須是不同的.',
    'digits'               => '該 :attribute 一定是 :digits 數字.',
    'digits_between'       => '該 :attribute 必須在之間 :min 和 :max 數字.',
    'dimensions'           => '該 :attribute 圖像尺寸無效.',
    'distinct'             => '該 :attribute 字段具有重複值.',
    'email'                => '該 :attribute 必須是一個有效的E-mail地址.',
    'exists'               => '該 選 :attribute 是無效的.',
    'file'                 => '該 :attribute 必須是一個文件.',
    'filled'               => '該 :attribute 字段必須具有值.',
    'gt'                   => [
        'numeric' => '該 :attribute 必須大於 :value.',
        'file'    => '該 :attribute 必須大於 :value 千字節.',
        'string'  => '該 :attribute 必須大於 :value 人物.',
        'array'   => '該 :attribute 必須有更多 :value 項目.',
    ],
    'gte'                  => [
        'numeric' => '該 :attribute 必須大於或等於 :value.',
        'file'    => '該 :attribute 必須大於或等於 :value 千字節.',
        'string'  => '該 :attribute must 大於或等於 :value 人物.',
        'array'   => '該 :attribute 一定有 :value 物品或更多.',
    ],
    'image'                => '該 :attribute 必須是一個形象.',
    'in'                   => '該 選 :attribute 是無效的.',
    'in_array'             => '該 :attribute 字段不存在於 :other.',
    'integer'              => '該 :attribute 必須是整數.',
    'ip'                   => '該 :attribute 必須是有效的IP地址.',
    'ipv4'                 => '該 :attribute 必須是有效的IPv4地址.',
    'ipv6'                 => '該 :attribute 必須是有效的IPv6地址.',
    'json'                 => '該 :attribute 必須是有效的JSON字符串.',
    'lt'                   => [
        'numeric' => '該 :attribute 必須小於 :value.',
        'file'    => '該 :attribute 必須小於 :value 千字節.',
        'string'  => '該 :attribute 必須小於 :value 人物.',
        'array'   => '該 :attribute 必須少於 :value 項目.',
    ],
    'lte'                  => [
        'numeric' => '該 :attribute 必須小於或等於 :value.',
        'file'    => '該 :attribute 必須小於或等於 :value 千字節.',
        'string'  => '該 :attribute 必須小於或等於 :value 人物.',
        'array'   => '該 :attribute 一定不能超過 :value 項目.',
    ],
    'max'                  => [
        'numeric' => '該 :attribute 可能不會大於 :max.',
        'file'    => '該 :attribute 可能不會大於 :max 千字節.',
        'string'  => '該 :attribute 可能不會大於 :max 人物.',
        'array'   => '該 :attribute 可能不會超過 :max 項目.',
    ],
    'mimes'                => '該 :attribute 必須是類型的文件: :values.',
    'mimetypes'            => '該 :attribute 必須是類型的文件: :values.',
    'min'                  => [
        'numeric' => '該 :attribute 必須至少 :min.',
        'file'    => '該 :attribute 必須至少 :min 千字節.',
        'string'  => '該 :attribute 必須至少 :min 人物.',
        'array'   => '該 :attribute 必須至少有 :min 項目.',
    ],
    'not_in'               => '該 選 :attribute 是無效的.',
    'not_regex'            => '該 :attribute 格式無效.',
    'numeric'              => '該 :attribute 必須是一個數字.',
    'present'              => '該 :attribute 領域必須存在.',
    'regex'                => '該 :attribute 格式無效.',
    'required'             => '該 :attribute 字段是必需的.',
    'required_if'          => '該 :attribute 字段是必需的 :other 是 :value.',
    'required_unless'      => '該 :attribute 除非是必填字段 :other 在... :values.',
    'required_with'        => '該 :attribute 字段是必需的 :values 是 當下.',
    'required_with_all'    => '該 :attribute 字段是必需的 :values 是 當下.',
    'required_without'     => '該 :attribute 字段是必需的 :values 是 不存在.',
    'required_without_all' => '該 :attribute 沒有一個字段是必需的 :values 存在.',
    'same'                 => '該 :attribute 和 :other 必須匹配.',
    'size'                 => [
        'numeric' => '該 :attribute 一定是 :size.',
        'file'    => '該 :attribute 一定是 :size 千字節.',
        'string'  => '該 :attribute 一定是 :size 人物.',
        'array'   => '該 :attribute 必須包含 :size 項目.',
    ],
    'string'               => '該 :attribute 必須是一個字符串.',
    'timezone'             => '該 :attribute 必須是有效的區域.',
    'unique'               => '該 :attribute 已有人帶走了.',
    'uploaded'             => '該 :attribute 無法上傳.',
    'url'                  => '該 :attribute 格式無效.',

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
