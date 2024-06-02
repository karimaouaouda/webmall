<?php

return [

    'table_name' => 'rates',
    'amount_key' => 'starts_count',
    'comment_key' => 'comment',

    'raters' => [
        'seller' => App\Models\Auth\Seller::class,
        'client' => App\Models\Auth\Client::class,
    ],

    'targets' => [
        'product' => \App\Models\Shop\Product::class,
        'shop' => \App\Models\Shop::class
    ],

    'matcher' => [
        'seller' => ["product", "shop"],
        'client' => ["product", "shop"]
    ]
];
