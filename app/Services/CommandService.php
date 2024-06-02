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
