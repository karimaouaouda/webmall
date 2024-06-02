<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreFavoriteRequest;
use App\Models\Client\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = auth('client')->user();

        return view('someview', compact('client'));
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
    public function store(StoreFavoriteRequest $request)
    {
        $client = auth('client')->user()->id;

        $favorite = $client->favorites()->where('product_id', '=', $request->input('product_id'))->get();

        if( $favorite->isEmpty() ){

            DB::table('favorites')
                ->insert([
                    'client_id' => $client->id,
                    'product_id' => $request->input('product_id'),
                ]);

            return response()->json([
                'message' => 'successfully added'
            ], 200);

        }else{
            $favorite->delete();
            return response()->json([
                'message' => 'successfully removed'
            ], 200);

        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
