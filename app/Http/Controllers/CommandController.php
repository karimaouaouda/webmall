<?php

namespace App\Http\Controllers;

use App\Enums\CommandStatus;
use App\Models\Client\Command;
use App\Http\Requests\StoreCommandRequest;
use App\Http\Requests\UpdateCommandRequest;
use App\Models\Shop\Product;
use Illuminate\Support\Facades\DB;

class CommandController extends Controller
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
    public function create(Product $product)
    {
        return view('product.pay', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product)
    {
        $command = new Command([
            'client_id' => auth('client')->user()->id,
            'payment_method' => 'baridimob'
        ]);

        $command->save();

        DB::table('commands_products')->insert([
            'command_id' => $command->id,
            'product_id' => $product->id,
            'tracking_code' =>  '1000',
            'status' => CommandStatus::Processing,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->to(route('discover', ['domain' => 'www']));

    }

    /**
     * Display the specified resource.
     */
    public function show(Command $command)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Command $command)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandRequest $request, Command $command)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Command $command)
    {
        //
    }
}
