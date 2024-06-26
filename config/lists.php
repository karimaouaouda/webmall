<?php
 /**
  * inn the application there are many dlists like account ...
  * in this file you will find the different lists with this url actions
  */

return [

    'account' => [
        'default' => [
            'auth' => [
                'icons' => true,

                'items' => [
                    [
                        'icon' => 'person',
                        'label' => 'dashboard',
                        'url' => 'https://www.webmall.test/dashboard',
                    ],
                    [
                        'icon' => 'person-circle',
                        'label' => 'profile',
                        'url' => 'https://www.webmall.test/dashboard',
                    ],
                    [
                        'icon' => 'boxes',
                        'label' => 'my commands',
                        'url' => 'https://www.webmall.test/dashboard/commands',
                    ]
                ]
            ],

            'guest' => [
                'icons' => false,

                'items' => [
                    [
                        'label' => 'register',
                        'url' => 'https://www.webmall.test/dashboard/register',
                        'icon' => 'person-plus'
                    ],
                    [
                        'label' => 'login',
                        'url' => 'https://www.webmall.test/dashboard/login',
                        'icon' => 'box-arrow-in-right'
                    ]
                ]
            ]
        ]
    ]


];
