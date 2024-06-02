<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Enums\CommandStatus;
use App\Models\Client\Command;
use App\Http\Requests\StoreCommandRequest;
use App\Http\Requests\UpdateCommandRequest;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

#[AllowDynamicProperties] class CommandController extends Controller
{

    public function __construct()
    {
        $this->service = new \CommandService(auth('client')->user());
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
    public function create(Request $request)
    {
        if( !auth('client')->check() ){
            return redirect()->to(route('filament.client.auth.login'));
        }
        $source = 'cart';
        if( $request->has('source') ){
            $source = !in_array($request->input('source'), ['cart','view']) ?
                                        $source :
                                        $request->input('source');
        }

        $products = null;
        $client = auth('client')->user();

        switch ($source){
            case 'cart' :

                $products = auth('client')->user()->cart->items;

                break;
            case 'view':
                if(
                    !$request->has('pid') ||
                    ( Product::find($request->input('pid')) === null)
                ){
                    abort(404);
                }
                $products = Product::where('id', '=', $request->input('pid'))->get();
                break;
            default:

        }
        return view('product.pay', compact('products', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandRequest $request)
    {

        $client = auth('client')->user();

        $items = json_decode($request->items, true);

        $address = null;

        if( $request->input('address_to_use') == 'request' ){
            $address = $this->service->extractAddress($request);
        }

        DB::transaction(function() use ($client, $items){

            $command = new Command([
                'client_id' => $client->id,
                'ship_to' => $address ? json_encode($address) : null,
                'status' => CommandStatus::Processing
            ]);

            $command->save();

            foreach ($items as $item){

                DB::table('commands_products')
                        ->insert([
                            'command_id' => $command->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'tracking_code' => 'xx-xxxxx',
                            'sold' => Product::find($item['product_id'])->solde,
                            'status' => CommandStatus::Processing->value,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
            }
        }, 2);

        return redirect()->to(route('discover'))->with('status', 'your command was successfully placed');

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
