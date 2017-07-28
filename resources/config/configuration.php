<?php

return [
    'access_token' => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted',
    ],
    'prefix'       => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
];
