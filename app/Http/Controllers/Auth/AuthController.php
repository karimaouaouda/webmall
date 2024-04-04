<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    protected $guard;
    public function __construct(
        StatefulGuard $guard
    )
    {
        $this->guard = $guard;
    }


    public function socialRedirect($domain, $service){
        $this->validateService($service);

        if($service == "fb"){
            $service = "facebook";
        }

        return Socialite::driver($service)->redirect();

    }


    public function socialCallback($domain, $service){
        $this->validateService($service);

        if($service == "fb"){
            $service = "facebook";
        }

        try {
            $user = Socialite::driver($service)->user();
        } catch (\Throwable $th) {
            $user = Socialite::driver($service)->stateless()->user();
        }

        dd($user);

    }

    private function validateService($service = null){
        $services = Config::get('services.socialite', null);

        if($service == null || $services == null || !in_array($service, $services)){
            throw new Exception("no service $service available", 400);
        }
    }
}
