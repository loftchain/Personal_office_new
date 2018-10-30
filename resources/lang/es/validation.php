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
    'unique_wallet'        => 'Esta billetera ya está tomada.',
    'unique_wallet_update' => 'Esta billetera ya está tomada.',
    'accepted'             => 'La :attribute debe ser aceptado.',
    'active_url'           => 'La :attribute no es una URL válida.',
    'after'                => 'La :attribute debe ser una fecha después :date.',
    'after_or_equal'       => 'La :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'La :attribute Solo puede contener letras.',
    'alpha_dash'           => 'La :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'La :attribute Solo puede contener letras y números.',
    'array'                => 'La :attribute debe ser una matriz',
    'before'               => 'La :attribute debe ser una fecha antes :date.',
    'before_or_equal'      => 'La :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'La :attribute debe estar entre :min y :max.',
        'file'    => 'La :attribute must estar entre :min y :max kilobytes.',
        'string'  => 'La :attribute must estar entre :min y :max characters.',
        'array'   => 'La :attribute must tener entre :min y :max artículos.',
    ],
    'boolean'              => 'La :attribute El campo debe ser verdadero o falso.',
    'confirmed'            => 'La :attribute la confirmación no coincide.',
    'date'                 => 'La :attribute no es una fecha válida.',
    'date_format'          => 'La :attribute no coincide con el formato :format.',
    'different'            => 'La :attribute and :other debe ser diferente',
    'digits'               => 'La :attribute debe ser :digits dígitos.',
    'digits_between'       => 'La :attribute debe estar entre :min andy :max dígitos.',
    'dimensions'           => 'La :attribute tiene dimensiones de imagen inválidas.',
    'distinct'             => 'La :attribute El campo tiene un valor duplicado.',
    'email'                => 'La :attribute Debe ser una dirección de correo electrónico válida.',
    'exists'               => 'La seleccionado :attribute no es válido.',
    'file'                 => 'La :attribute debe ser un archivo.',
    'filled'               => 'La :attribute El campo debe tener un valor.',
    'gt'                   => [
        'numeric' => 'La :attribute debe ser mayor que :value.',
        'file'    => 'La :attribute debe ser mayor que :value kilobytes.',
        'string'  => 'La :attribute debe ser mayor que :value caracteres.',
        'array'   => 'La :attribute debe ser mayor que :value artículos.',
    ],
    'gte'                  => [
        'numeric' => 'La :attribute debe ser mayor o igual que :value.',
        'file'    => 'La :attribute debe ser mayor o igual que :value kilobytes.',
        'string'  => 'La :attribute debe ser mayor o igual que :value caracteres.',
        'array'   => 'La :attribute debe tener :value artículos o más.',
    ],
    'image'                => 'La :attribute debe ser una imagen',
    'in'                   => 'La seleccionado :attribute no es válido.',
    'in_array'             => 'La :attribute campo no existe en :other.',
    'integer'              => 'La :attribute debe ser un entero.',
    'ip'                   => 'La :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'La :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'La :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'La :attribute debe ser una cadena JSON válida.',
    'lt'                   => [
        'numeric' => 'La :attribute must be less than :value.',
        'file'    => 'La :attribute must be less than :value kilobytes.',
        'string'  => 'La :attribute must be less than :value characters.',
        'array'   => 'La :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => 'La :attribute debe ser menor o igual :value.',
        'file'    => 'La :attribute debe ser menor o igual :value kilobytes.',
        'string'  => 'La :attribute debe ser menor o igual :value caracteres.',
        'array'   => 'La :attribute no debe tener más de :value artículos.',
    ],
    'max'                  => [
        'numeric' => 'La :attribute no puede ser mayor que :max.',
        'file'    => 'La :attribute no puede ser mayor que :max kilobytes.',
        'string'  => 'La :attribute no puede ser mayor que :max caracteres.',
        'array'   => 'La :attribute no puede tener más de :max artículos.',
    ],
    'mimes'                => 'La :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'La :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'La :attribute al menos debe ser :min.',
        'file'    => 'La :attribute al menos debe ser :min kilobytes.',
        'string'  => 'La :attribute al menos debe ser :min caracteres.',
        'array'   => 'La :attribute debe tener al menos :min artículos.',
    ],
    'not_in'               => 'La seleccionado :attribute no es válido.',
    'not_regex'            => 'La :attribute el formato no es válido.',
    'numeric'              => 'La :attribute tiene que ser un número.',
    'present'              => 'La :attribute el campo debe estar presente.',
    'regex'                => 'La :attribute el formato no es válido.',
    'required'             => 'La :attribute se requiere campo.',
    'required_if'          => 'La :attribute campo es requerido cuando :other es :value.',
    'required_unless'      => 'La :attribute campo es obligatorio a menos que :other es en :values.',
    'required_with'        => 'La :attribute campo es requerido cuando :values es presente.',
    'required_with_all'    => 'La :attribute campo es requerido cuando :values es presente.',
    'required_without'     => 'La :attribute campo es requerido cuando :values es no presente.',
    'required_without_all' => 'La :attribute campo es requerido cuando ninguno de :values están presentes.',
    'same'                 => 'La :attribute y :other debe coincidir con.',
    'size'                 => [
        'numeric' => 'La :attribute debe ser :size.',
        'file'    => 'La :attribute debe ser :size kilobytes.',
        'string'  => 'La :attribute debe ser :size caracteres.',
        'array'   => 'La :attributedebe contener :size artículos.',
    ],
    'string'               => 'La :attribute debe ser una cadena',
    'timezone'             => 'La :attribute debe ser una zona válida.',
    'unique'               => 'La :attribute ya se ha tomado.',
    'uploaded'             => 'La :attribute error al subir.',
    'url'                  => 'La :attribute el formato no es válido.',

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
