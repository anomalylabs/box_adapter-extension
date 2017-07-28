<?php

return [
    'access_token' => [
        'label'        => 'Access Token',
        'instructions' => 'Enter your Box oAuth token.',
    ],
    'prefix'       => [
        'label'        => 'Use disk slug as prefix?',
        'instructions' => 'If disabled, the bucket\'s root directory will be used.',
        'warning'      => 'Disabling may cause file collisions if the same bucket is used for multiple disks.',
    ],
];
