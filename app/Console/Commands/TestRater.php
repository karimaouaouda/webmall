<?php

namespace App\Console\Commands;

use App\Models\Auth\Client;
use App\Models\Auth\Seller;
use App\Models\Shop\Product;
use Illuminate\Console\Command;

class TestRater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-rater';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $product = Product::all()->first();

        try{
            $this->output->info($product->raters);
        }catch (\Exception $e){
            $this->output->info($e->getMessage());
        }

    }
}
