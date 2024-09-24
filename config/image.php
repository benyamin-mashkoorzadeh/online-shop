<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports “GD Library” and “Imagick” to process images
    | internally. Depending on your PHP setup, you can choose one of them.
    |
    | Included options:
    |   - \Intervention\Image\Drivers\Gd\Driver::class
    |   - \Intervention\Image\Drivers\Imagick\Driver::class
    |
    */

    'driver' => \Intervention\Image\Drivers\Gd\Driver::class,

    // Index Size
    'index-image-sizes' => [
        'large' => [
            'width' => 800,
            'height' => 600
        ],
        'medium' => [
            'width' => 350,
            'height' => 350
        ],
        'small' => [
            'width' => 80,
            'height' => 60
        ]
    ],

    'default-current-index-image' => 'medium',

    // Index Size
    'cache-image-sizes' => [
    'large' => [
        'width' => 800,
        'height' => 600
    ],
    'medium' => [
        'width' => 400,
        'height' => 300
    ],
    'small' => [
        'width' => 80,
        'height' => 60
    ]
],

    'default-current-cache-image' => 'medium',
    'image-cache-life-time' => 10,
    'image-not-found' => ''


];
