<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Support\Facades\Config;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function view($domain){
        dd($domain);
    }

    public function start(){
        $seller = auth('seller')->user();

        if(!$seller->hasAddress()){
            $next = base64_encode(Config::get('app.seller.domain'). '/dashboard/settings#id');
            return redirect()->to('/dashboard/settings#address/?next=' . $next);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("auth.seller.register", [
            "etap" => 2
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
