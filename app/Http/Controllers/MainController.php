<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Shop;
use App\Models\Shop\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

class MainController extends Controller
{
    public function index(Request $request): View|Application|Factory
    {
        $shops = Shop::all();

        $superDeals = Product::query()
                        ->orderBy('solde')
                        ->limit(15)
                        ->get();

        $welcomeDeals = Product::query()
                            ->orderBy('welcome_solde')
                            ->limit(15)
                            ->get() ?? [];

        $products = $superDeals->merge($welcomeDeals);

        $shops = Shop::query()->limit(15)->get();

        return view("guest.welcome", compact(
            'shops',
            'products',
            'superDeals',
            'welcomeDeals')
        );
    }


    public function send(Request $request): JsonResponse
    {
        $message = $request->input('message');

        $client = new Client("AIzaSyAXCj72FC7XYaYZTSVqST7JFaua-yw9bnI");

        $history = auth('client')->user()->messages;

        $his = 'hello gemini you are a client assistant for helping people to chose gifts for their friends after talking to them and this is descussion with hem : ';
        foreach ($history as $msg){

            $his  = $his . 'you : ' . $msg->content . ' gemini : ' . $msg->gpt_response;

        }

        $response = $client->geminiPro()->generateContent(
            new TextPart($his . 'you : ' .$message)
        );




        $content = $response->text();

        $message = new Message([
            "client_id" => auth('client')->user()->id,
            "content" => $message,
            'gpt_response' => $content
        ]);

        $message->save();


        return response()->json([
            "content" => $content, //$process->output(),
        ], 200);

    }

    public function interests(){
        return view('interests');
    }


    public function discover(){
        $products  = Product::all();

        return view("discover", compact('products'));
    }
}
