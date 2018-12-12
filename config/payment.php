<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Payment packages, currencies, coupons
    |--------------------------------------------------------------------------
    */

    'types' => [
        'video' => [
            'label'  => 'Video(s)',
            'description' => ':qty Virtual Coach Video|:qty Virtual Coach Videos',
            'price' => [
                'usd' => 25000, // 250$ in cents
                'gbp' => 17000, // 170£ in pence
                'eur' => 24000, // 240€ in cents
            ],
            'items' => [
                'vcoaches' => 1,
                'type' => 'vcoaches'
            ],
        ],
        'session'   => [
            'label'  => 'Session(s)',
            'description' => ':qty Coaching Session|:qty Coaching Sessions',
            'price' => [
                'usd' => 25000, // 250$ in cents
                'gbp' => 17000, // 170£ in pence
                'eur' => 24000, // 240€ in cents
            ],
            'items' => [
                'sessions' => 1,
                'type' => 'session'
            ],
        ],
        'package_1' => [
            'label'  => 'Video & Session Package(s)',
            'description' => ':qty Package of Virtual Coach Video and Coaching Session|:qty Packages
                                of Virtual Coach Video and Coaching Session',
            'price' => [
                'usd' => 49500, // 495$ in cents
                'gbp' => 33500, // 335£ in pence
                'eur' => 47500, // 475€ in cents
            ],
            'items' => [
                'vcoaches' => 1,
                'sessions' => 1,
                'type' => 'package_1'
            ],
        ],
    ],

    'currencies' => [
        'usd' => [
            'symbol' => '$',
            'title' => 'United States Dollar',
        ],
        'gbp' => [
            'symbol' => '£',
            'title' => 'British Pound',
        ],
        'eur' => [
            'symbol' => '€',
            'title' => 'Euro',
        ],
    ],

    'coupons' => [
        'discount' => [
            'description' => '− :discount% discount',
        ],
        'free' => [
            'description' => '+ Free: :text',
        ],
    ],

);
