<?php

return [
    'role_structure' => [
        'admin' => [
            'portal' => 'r,c,d,u',
            'intranet' => 'r,c,d,u',
            'user' => 'r,c,d,u',
            'cms' => 'r,c,d,u',
        ],
        'manager' => [
            'portal' => 'r,c,d,u',
            'intranet' => 'r',
            'user' => 'r'
        ],
        'trainer' => [
            'portal' => 'r,c,d,u',
            'intranet' => 'r',
            'user' => 'r'
        ],
        'user' => [
            'portal' => 'r'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
