<?php

namespace Database\Seeders;

use App\Models\Shop\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected array $phones = [
        [
            "slug" => "iphone-13-pro",
            "description" => "Apple iPhone 13 Pro with 128GB storage and A15 Bionic chip.",
            "price" => 999.99,
            "solde" => 10
        ],
        [
            "slug" => "samsung-galaxy-s21",
            "description" => "Samsung Galaxy S21 with 256GB storage and Exynos 2100.",
            "price" => 849.99,
            "solde" => 15
        ],
        [
            "slug" => "google-pixel-6",
            "description" => "Google Pixel 6 with 128GB storage and Google Tensor chip.",
            "price" => 699.99,
            "solde" => 20
        ],
        [
            "slug" => "oneplus-9-pro",
            "description" => "OnePlus 9 Pro with 256GB storage and Snapdragon 888.",
            "price" => 969.99,
            "solde" => 12
        ],
        [
            "slug" => "xiaomi-mi-11",
            "description" => "Xiaomi Mi 11 with 128GB storage and Snapdragon 888.",
            "price" => 749.99,
            "solde" => 18
        ],
        [
            "slug" => "sony-xperia-1-iii",
            "description" => "Sony Xperia 1 III with 256GB storage and Snapdragon 888.",
            "price" => 1299.99,
            "solde" => 8
        ],
        [
            "slug" => "oppo-find-x3-pro",
            "description" => "Oppo Find X3 Pro with 256GB storage and Snapdragon 888.",
            "price" => 1099.99,
            "solde" => 10
        ],
        [
            "slug" => "huawei-p50-pro",
            "description" => "Huawei P50 Pro with 256GB storage and Kirin 9000.",
            "price" => 999.99,
            "solde" => 5
        ],
        [
            "slug" => "asus-rog-phone-5",
            "description" => "Asus ROG Phone 5 with 512GB storage and Snapdragon 888.",
            "price" => 1199.99,
            "solde" => 10
        ],
        [
            "slug" => "motorola-edge-plus",
            "description" => "Motorola Edge Plus with 256GB storage and Snapdragon 865.",
            "price" => 799.99,
            "solde" => 20
        ],
        [
            "slug" => "nokia-xr20",
            "description" => "Nokia XR20 with 128GB storage and Snapdragon 480.",
            "price" => 549.99,
            "solde" => 15
        ],
        [
            "slug" => "realme-gt",
            "description" => "Realme GT with 128GB storage and Snapdragon 888.",
            "price" => 599.99,
            "solde" => 25
        ],
        [
            "slug" => "vivo-x60-pro",
            "description" => "Vivo X60 Pro with 256GB storage and Snapdragon 870.",
            "price" => 799.99,
            "solde" => 10
        ],
        [
            "slug" => "lg-wing",
            "description" => "LG Wing with 256GB storage and Snapdragon 765G.",
            "price" => 999.99,
            "solde" => 30
        ],
        [
            "slug" => "zte-axon-30",
            "description" => "ZTE Axon 30 with 128GB storage and Snapdragon 870.",
            "price" => 499.99,
            "solde" => 20
        ]
    ];

    public function run(): void
    {
        $missing = [
            'sub_category_name' => 'Mobile Phones',
            'shop_unique_name' => 'condor',
            'welcome_solde' => 15,
            'available_qte' => 1500,
            'sensitive_qte' => 15,
            'video_path' => 'video.mp4',
        ];


        foreach($this->phones as $phone){
            $p = new Product(array_merge($phone, $missing));

            $p->save();

            for($i = 0; $i < 7; $i++){
                DB::table('product_images')
                    ->insert([
                        'product_id' => $p->id,
                        'path' => 'pic_'.$i.'.png' ,
                        'primary' => $i === 2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }
    }
}
