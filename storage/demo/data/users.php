<?php


use Illuminate\Support\Facades\Hash;


$default_password = 'webmall123';

return [
    'clients' => [

    ],

    'sellers' => [

    ],

    'admins' => [
        [
            'name' => 'karim aouaouda',
            'email' => 'karimaouaouda.officiel@gmail.com',
            'password' => Hash::make($default_password)
        ],
        [
            'name' => 'aya redjil',
            'email' => 'ayaredjil.officiel@gmail.com',
            'password' => Hash::make($default_password)
        ]
    ]
];
