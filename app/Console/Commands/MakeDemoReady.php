<?php

namespace App\Console\Commands;

use App\Enums\ShopStatus;
use App\Models\Shop;
use Illuminate\Console\Command;

class MakeDemoReady extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-demo {--random}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dataFiles = ['admins', 'sellers', 'shops', 'clients', 'shipping_methods'];

        $path = storage_path('/app/demo');


        $this->withProgressBar($dataFiles, function($file) use ($path){
            $filepath = $path . "/{$file}.php";

            $arr = require($filepath);

            if($file == 'shops'){
                $this->handleShops($arr);
                return true;
            }

            foreach ($arr['records'] as $record){

                $model = new $arr['model']($record);

                $model->save();

            }

            $this->output->info("finish generate data for file {$file}.php");
            $this->newLine();


            return true;

        });
    }


    public function handleShops($shops){


        foreach ($shops as $shop){

            $missing = [
                'status' => ShopStatus::Processing->value,
                'logo' => 'sellers/seller_1/shop/images/01HZDBM3M2PAPMM6J7GKBGVK29.png',
                'cover' => 'sellers/seller_1/shop/images/01HZDBM3MG0PQCD3068M7BTWRA.png',
            ];

            $newShop = array_merge($shop, $missing);

            $sh = new Shop($newShop);

            $sh->save();

        }


    }
}
