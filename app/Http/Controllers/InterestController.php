<?php

namespace App\Http\Controllers;

use App\Models\Client\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterestController extends Controller
{
    /**
     * Save a list of interests in a user
    */
    public function save(Request $request){
        $client = auth('client')->user();

        foreach ($request->input('interests') as $interest){
            DB::table('interests')
                ->insert([
                    'client_id' => $client->id,
                    'sub_category_name' =>  $interest,
               'created_at' => now(),
               'updated_at' => now()
            ]);
        }

        return response()->json([
            "message" => "intersts save successfully"
        ], 200);
    }
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
    public function show(Interest $interest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interest $interest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interest $interest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interest $interest)
    {
        //
    }
}
