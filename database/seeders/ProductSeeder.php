<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

use function GuzzleHttp\Promise\each;

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

        // $count = 20000;
        // for ($i = 0; $i < $count; $i++) {

        //     $products = [

        //         'name' => 'procuct' . $i,
        //         'category_id' => rand(2, 3),
        //         'price' => 100,
        //         'size' => 1,

        //     ];
        //     Product::create($products);
        // }
    }
}
