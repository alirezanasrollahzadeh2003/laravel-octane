<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fa_IR');

        foreach (range(1, 100) as $i) {
            Product::create([
                'name' => 'محصول شماره ' . $i . ' - ' . $faker->word,
                'description' => $faker->sentence(10),
                'price' => $faker->numberBetween(500000, 50000000),
            ]);
        }
    }
}
