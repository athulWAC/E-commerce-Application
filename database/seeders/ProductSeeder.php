<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                'name' => 'nike',
                'category_id' => 1,
                'price' => 100,
            ],
            [
                'name' => 'lenovo',
                'category_id' => 2,
                'price' => 1400,
            ],
            [
                'name' => 'realme',
                'category_id' => 2,
                'price' => 1432,
            ]


        ];



        foreach ($products as $product) {
            Product::create($product);
        }





        // Product::create($product);
    }
}
