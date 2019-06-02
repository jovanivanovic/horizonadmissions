<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'interview_types' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'staff' => [
            'interviews' => 'r,u',
            'profile' => 'r,u'
        ],
        'student' => [
            'interviews' => 'c,r',
            'profile' => 'r,u'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
