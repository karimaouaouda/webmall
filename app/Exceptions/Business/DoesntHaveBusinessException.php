<?php

namespace App\Exceptions\Business;

use Exception;

class DoesntHaveBusinessException extends Exception
{
    
    public function __construct(string $seller_name) {
        $message = "dear $seller_name you must have a shop to enter your dashboard";

        parent::__construct($message);
    }


    public function getRedirectUrl(){
        //dd(route('seller.register', ['tab' => '2']));
        return route('seller.register', ['tab' => '2']);
    }
}
