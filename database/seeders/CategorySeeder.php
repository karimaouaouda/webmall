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
        [
            'category' => 'Electronics',
            'subcategories' => [
                'Mobile Phones',
                'Laptops',
                'Cameras',
                'Televisions'
            ]
        ],
        [
            'category' => 'Home Appliances',
            'subcategories' => [
                'Refrigerators',
                'Washing Machines',
                'Microwave Ovens',
                'Air Conditioners'
            ]
        ],
        [
            'category' => 'Fashion',
            'subcategories' => [
                'Men\'s Clothing',
                'Women\'s Clothing',
                'Shoes',
                'Accessories'
            ]
        ],
        [
            'category' => 'Beauty & Personal Care',
            'subcategories' => [
                'Skincare',
                'Haircare',
                'Makeup',
                'Fragrances'
            ]
        ],
        [
            'category' => 'Sports & Outdoors',
            'subcategories' => [
                'Fitness Equipment',
                'Outdoor Gear',
                'Sportswear',
                'Camping & Hiking'
            ]
        ],
        [
            'category' => 'Toys & Games',
            'subcategories' => [
                'Action Figures',
                'Board Games',
                'Educational Toys',
                'Puzzles'
            ]
        ],
        [
            'category' => 'Automotive',
            'subcategories' => [
                'Car Accessories',
                'Motorcycle Parts',
                'Car Electronics',
                'Tires & Wheels'
            ]
        ],
        [
            'category' => 'Books',
            'subcategories' => [
                'Fiction',
                'Non-Fiction',
                'Educational',
                'Children\'s Books'
            ]
        ],
        [
            'category' => 'Music & Movies',
            'subcategories' => [
                'Music CDs',
                'Vinyl Records',
                'DVDs',
                'Blu-ray Discs'
            ]
        ],
        [
            'category' => 'Health & Wellness',
            'subcategories' => [
                'Supplements',
                'Personal Care',
                'Medical Supplies'
            ]
        ],
        [
            'category' => 'Groceries',
            'subcategories' => [
                'Fruits & Vegetables',
                'Beverages',
                'Snacks',
                'Dairy Products'
            ]
        ],
        [
            'category' => 'Office Supplies',
            'subcategories' => [
                'Stationery',
                'Office Furniture',
                'Printers & Ink',
                'Office Electronics'
            ]
        ],
        [
            'category' => 'Pet Supplies',
            'subcategories' => [
                'Pet Food',
                'Pet Toys',
                'Pet Grooming',
                'Pet Accessories'
            ]
        ],
        [
            'category' => 'Garden & Outdoors',
            'subcategories' => [
                'Gardening Tools',
                'Outdoor Furniture',
                'Plants & Seeds',
                'Grills & Outdoor Cooking'
            ]
        ],
        [
            'category' => 'Baby Products',
            'subcategories' => [
                'Baby Clothing',
                'Baby Gear',
                'Diapering',
                'Feeding'
            ]
        ]
    ];
public function run(): void
    {
        foreach ($this->categories as $category){
            $cat = new Category([
                'name' => $category['category']
            ]);

            $cat->save();

            foreach ($category['subcategories'] as $subcategory){
                $sub = new SubCategory([
                    'category_name' => $category['category'],
                    'name' => $subcategory
                ]);

                $sub->save();
            }
        }
    }
}
