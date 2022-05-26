<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            [
                'size_name' => 'SM',
                'price' => 100,
            ], [
                'size_name' => 'MD',
                'price' => 110,
            ], [
                'size_name' => 'LG',
                'price' => 125,
            ], [
                'size_name' => 'XL',
                'price' => 150,
            ], [
                'size_name' => 'XXL',
                'price' => 150,
            ], [
                'size_name' => 'XXXL',
                'price' => 160,
            ]
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
