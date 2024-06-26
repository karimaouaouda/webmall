<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Enums\CommandStatus;
use App\Models\Client\Command;
use App\Http\Requests\StoreCommandRequest;
use App\Http\Requests\UpdateCommandRequest;
use App\Models\Shop\Product;
use App\Services\CommandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

#[AllowDynamicProperties] class CommandController extends Controller
{

    public function __construct()
    {
        $this->service = new CommandService(auth('client')->user());
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

                foreach ($products as $product){
                    $product->pivot = [
                        'quantity' => $request->input('qte') ?? 1,
                    ];
                }
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

        $items = is_array($request->items) ? $request->items : json_decode($request->items, true);

        $items = array_map(function($item){
            return json_decode($item, true);
        }, $items);

        $commands = $this->service->resolveCommands($items);

        //dd($commands);

        $address = null;

        if( $request->input('address_to_use') == 'request' ){
            $address = $this->service->extractAddress($request);
        }

        DB::transaction(function() use ($client, $address, $commands){



            foreach ($commands as $command){

                $cmd = new Command([
                    'client_id' => $client->id,
                    'shop_unique_name' => $command['shop_unique_name'],
                    'ship_to' => $address ? json_encode($address) : null,
                    'status' => CommandStatus::Processing
                ]);

                $cmd->save();

                foreach ($command['products'] as $item){

                    DB::table('commands_products')
                        ->insert([
                            'command_id' => $cmd->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'sold' => Product::find($item['product_id'])->solde,
                            //'status' => CommandStatus::Processing->value,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                }

            }






        }, 2);

        return response()->json([
            'message' => 'command placed successfully',
            'status' => 'success'
        ], 200);

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
