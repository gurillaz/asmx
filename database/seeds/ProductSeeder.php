<?php

use App\Brand;
use App\Category;
use App\User;
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
        $categories_id = Category::all()->pluck('id');


        $brands = Brand::all();
        $user = User::all()->first();

        // Products
        factory(App\Product::class, 7000)->create([
            'brand_id' => $brands->random()->id,
            'category_id' => $categories_id->random(),
            'user_id' => $user->id,
        ]);
    }
}
