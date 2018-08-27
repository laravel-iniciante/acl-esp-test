<?php

return [

    'filter' => [
         [
            'field'     => 'users.name',
            'operator'  => '%like%',
            'function'  => 'or',
            'paramName' => 'nome',
        ],
        [
            'field'     => 'users.email',
            'operator'  => '%like%',
            'function'  => 'where',
            'paramName' => 'email',
        ],
        [
            'field'     => 'role_user.role_id',
            'operator'  => 'like',
            'function'  => 'in',
            'paramName' => 'role',
        ],
        [
            'field'     => 'users.remember_token',
            'operator'  => '=',
            'function'  => 'null',
            'paramName' => 'remember_token',
        ],
    ],

    'user_photo' => [
        'fieldInput' => 'file',
        'extensions' => ['jpeg','jpg','png'],
        'path'       => 'images',
        'dbFieldFile'=> 'photo',
        'thumbs'     => [
            'sizes' => [
                'mini' => [150,100],
                'media' => [300,200],
                'grande' => [800,800]
            ]

        ]
    ],

    
];


