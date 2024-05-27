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
                        'icon' => 'person-circle',
                        'label' => 'profile',
                         
                    ]
                ]
            ],

            'guest' => [
                'icons' => false,
                
                'items' => [
                    [
                        'label' => 'register',
                        'url' => 'https://client.webmall.test/register',
                        'icon' => 'person-plus'
                    ],
                    [
                        'label' => 'login',
                        'url' => 'https://client.webmall.test/login',
                        'icon' => 'box-arrow-in-right'
                    ]
                ]
            ]
        ]
    ]


];