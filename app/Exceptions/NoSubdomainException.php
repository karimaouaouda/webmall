<?php

namespace App\Exceptions;

use Exception;

class NoSubdomainException extends Exception
{


    protected $redirectTo;

    public function __construct($message = 'no subdomain', $status = 302, $direction)
    {
        parent::__construct($message, $status);

        $this->redirectTo(env("APP_URL")."/" . $direction);

        
    }

    public function redirectTo($url)
    {
        $this->redirectTo = $url;

        return $this;
    }

    public function getRedirectUrl(){
        return $this->redirectTo;
    }


}
