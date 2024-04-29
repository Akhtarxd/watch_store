<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1,100) as $value){
            
            Product::create([
                'name' => $faker->randomElement(Brands::pluck('name')).'Watch',
                'price' => $faker->numberBetween($min = 5000, $max = 100000),
                'sale_price' => $faker->numberBetween($min = 500, $max = 4999),
                'color' => $faker->randomElement(['Gold', 'Rose Gold', 'Silver', 'Black', 'Beige', 'Blue', 'Green']),
                'brand_id' => $faker->randomElement(Brands::pluck('id')),
                'product_code' => $faker->numerify('PRD-#######'),
                'gender' => $faker->randomElement(['Male','Female','Children','Unisex']),
                'function' => $faker->randomElement(Config::get('watchFuction')),
                'stock' => $faker->randomDigit(),
                'description' => $faker->text($maxNbChars = 200),
                'image' => $faker->imageUrl($width=50, $height=50),
                'is_active' => $faker->randomElement(['1','0']),
            ]);
        }
    }
}
