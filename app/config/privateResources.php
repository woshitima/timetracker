<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [
        'users' => [
            'index',
            'search',
            'edit',
            'create',
            'delete',
            'changePassword',
            'tracker',
            'time',
            'update',
            'workedhours',
            'save'
        ],
        'profiles' => [
            'index',
            'search',
            'edit',
            'create',
            'delete'
        ],
        'permissions' => [
            'index'
        ],

        'holidays' => [
            'index',
            'new',
            'create',
            'edit',
            'save'
        ],

        'late' => [
            'index',
            'edit',
            'new',
            'search',
            'save',
            'create'
        ],

        'latecomers' => [
            'index',
            'search',
            'delete'
        ],

        'tracker' => [
            'index',
            'test'
        ]
    ]
]);
