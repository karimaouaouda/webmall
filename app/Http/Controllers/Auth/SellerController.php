<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\Auth\Seller\AttemptToAuthenticate;
use App\Actions\Fortify\Auth\Seller\CreateSellerAccount;
use App\Actions\Fortify\Auth\Seller\RedirectIfMissingBusiness;
use App\Actions\Fortify\Auth\Seller\RedirectIfTwoFactorAuthenticatable;
use App\Http\Requests\StoreSellerRequest;
use App\Models\Auth\Seller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

//use App\Http\Responses\Auth\Admin\LoginResponse;

class SellerController extends Controller
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

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request)
    {
        //dd($this->guard);
        return view("auth.seller.login", ["guard"=> "seller"]);
    }

    public function registerView(){
        $etap = 1;//rand(1, 2);
        return view("auth.seller.register", compact('etap'));
    }

    /**
     * this function is to store the seller personal information
     */
    public function register(StoreSellerRequest $request)
    {
        $request->merge([
            'name' => $request->first_name . " " . $request->last_name
        ]);

        $newRequest =  (new Pipeline(app()))->send($request)->via('handle')->through([
            CreateSellerAccount::class,
        ])->thenReturn();

        $loginRequest = LoginRequest::createFrom($request);


        return $this->loginPipeline($loginRequest)->then(function($request){
            redirect('/dashboard');
        });

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
            return redirect("/dashboard");
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
            RedirectIfMissingBusiness::class
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
}

