<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\Auth\Client\AttemptToAuthenticate;
use App\Actions\Fortify\Auth\Client\RedirectIfTwoFactorAuthenticatable;
use App\Http\Requests\StoreClientRequest;
use App\Models\Auth\Client;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Socialite\Facades\Socialite;

//use App\Http\Responses\Auth\Admin\LoginResponse;

class ClientController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function handle()
    {
        return response()->json([
            "message" => "hello there"
        ]);
    }

    public function registerView(Request $request)
    {
        dd($this->guard);
        return view("auth.client.register");
    }

    public function register(StoreClientRequest $request)
    {

        $client = Client::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $client->save();


        $this->guard->login($client);


        return response()->json([
            "message" => "successfully registerd"
        ]);
    }



    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request)
    {

        return view("auth.client.login", ["guard" => "client"]);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return redirect()->to( 'https://client.webmall.test/dashboard' );
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            config('fortify.lowercase_usernames') ? CanonicalizeUsername::class : null,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return app(LogoutResponse::class);
    }

    //social auth
    public function socialRedirect($domain, $service)
    {
        $this->validateService($service);

        if ($service == "fb") {
            $service = "facebook";
        }

        return Socialite::driver($service)->redirect();
    }


    public function socialCallback($domain, $service)
    {
        $this->validateService($service);

        if ($service == "fb") {
            $service = "facebook";
        }

        try {
            $user = Socialite::driver($service)->user();
        } catch (\Throwable $th) {
            $user = Socialite::driver($service)->stateless()->user();
        }


        $targetUser = Client::updateOrCreate([
            $service . "_id" => $user->id,
        ], [
            'name' => $user->name,
            'email' => $user->email,
            $service . '_token' => $user->token,
            $service . '_refresh_token' => $user->refreshToken,
            'password' => Hash::make($user->token)
        ]);

        $targetUser->makeVisible(['password']);

        
        $this->guard->login($targetUser);

        return redirect()->to( 'https://client.webmall.test/test' );
    }

    private function validateService($service = null)
    {
        $services = Config::get('services.socialite', null);

        if ($service == null || $services == null || !in_array($service, $services)) {
            throw new \Exception("no service $service available", 400);
        }
    }
}
