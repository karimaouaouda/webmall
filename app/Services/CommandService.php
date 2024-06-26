<?php

namespace App\Services;

use App\Http\Requests\StoreCommandRequest;
use App\Models\Auth\Client;

class CommandService
{
    //protected Client $client;
    public function __construct(/*Client $client*/)
    {
        //$this->client = $client;
    }

    public function resolveCommands(array $products): array
    {
        $commands = [];

        foreach ($products as $product){
            $found = false;
            foreach($commands as $command){
                if( $command['shop_unique_name'] == $product['shop_unique_name'] ){
                    $found = true;

                    $command['products'] += [
                        'product_id' => $product['product_id'] ,
                        'quantity' => $product['quantity']
                    ];
                }
            }

            if(!$found){
                $commands[] = [
                    'shop_unique_name' => $product['shop_unique_name'],
                    'products' => [
                        [
                            'product_id' => $product['product_id'] ,
                            'quantity' => $product['quantity']
                        ]
                    ]
                ];
            }
        }


        return $commands;
    }

    public function extractAddress(StoreCommandRequest $request): array
    {

        $attrs = ['full_name', 'phone_number', 'street_line', 'city', 'province'];

        $arr = [];

        foreach ($attrs as $key){

            $arr[$key] = $request->input($key);

        }


        return $arr;

    }

}
