<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Auth\Seller;
use App\Models\Shop;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public StatefulGuard $guard; //by default will be set to seller guard when instantiate

    public function __construct(StatefulGuard $guard){
        $this->guard = $guard;
    }

    public function index(){
        return view('business.index');
    }


    public function create(): View|Application|Factory|RedirectResponse
    {

        $seller = $this->guard->user();

//        if(! $seller->hasVerifiedEmail()){
//            return view('business.create', [
//                'step' => 'email_verification'
//            ]);
//        }

        return redirect()->to('https://selller.webmall.test/dashboard');
    }

}
