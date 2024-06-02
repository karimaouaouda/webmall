<?php

namespace Database\Seeders;

use App\Models\Setup\Category;
use App\Models\Setup\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected array $categories = [
        "Electronics" => [
            "Mobile Phones",
            "Laptops",
            "Cameras",
            "Televisions"
        ],
        "Home Appliances" => [
            "Refrigerators",
            "Microwaves",
            "Washing Machines",
            "Air Conditioners"
        ],
        "Furniture" => [
            "Sofas",
            "Beds",
            "Dining Tables",
            "Chairs"
        ],
        "Clothing" => [
            "Men's Clothing",
            "Women's Clothing",
            "Kid's Clothing",
            "Accessories"
        ],
        "Books" => [
            "Fiction",
            "Non-Fiction",
            "Children's Books",
            "Academic"
        ],
        "Sports" => [
            "Cricket",
            "Football",
            "Tennis",
            "Fitness Equipment"
        ]
    ];
    public function run(): void
    {
        foreach ($this->categories as $category => $subcategories){
            $cat = new Category([
                'name' => $category
            ]);

            $cat->save();

            foreach ($subcategories as $subcategory){
                $sub = new SubCategory([
                    'category_name' => $category,
                    'name' => $subcategory
                ]);

                $sub->save();
            }
        }
    }
}
