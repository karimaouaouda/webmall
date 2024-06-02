<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
           'country' => ['required', 'in:algeria'],
           'city' => ['required', 'alpha', 'max:150'],
           'province' => ['required', 'alpha', 'max:150'],
           'postal_code' => ['required', 'integer', 'max:58100', 'min:10000'],
            'street_line' => ['required', 'max:250'],
        ]);

        $user = null;
        foreach (['seller', 'client'] as $guard){
            if( auth($guard)->check() ){
                $user = auth($guard)->user();
            }
        }

        if($user == null){
            abort(503);
        }

        $user->address->update($request->all());




        return redirect()->to("https://seller.webmall.test/dashboard" , 302);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
