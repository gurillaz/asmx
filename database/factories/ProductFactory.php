<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use App\Subject;
use App\Supplier;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $producer_no = Str::limit($faker->uuid, 7, '');

    $suppliers =    Supplier::with('subject:id')->get();
    $random_supplier = $suppliers->random();
    $supplier_subject_id = $random_supplier->subject->id;
    $supplier_id = $random_supplier->id;

    $buying_price = $faker->randomFloat(2, 0.5, 200);
    $cost = $buying_price * $faker->randomFloat(2, 1.1, 2);

    $category = Category::query()->get()->random();

    $category_id = $category->id;

    return [
        'name' => $faker->sentence(6),
        'second_name' => $faker->sentence(4),
        'stock_no' => $producer_no . '-' . $supplier_subject_id,
        'original_no' => Str::limit($faker->uuid, 4, ''),
        'supplier_no' => $producer_no,
        'producer_no' => $producer_no,
        'barcode' => Str::limit($faker->uuid, 12, ''),
        'quality' => $faker->randomElement(['0', '1', '2', '3', '4', '5']),
        'measuring_unit' => $faker->randomElement(['kg', 'cope', 'liter']),
        'weight' => $faker->randomFloat(2, 0.5, 20),
        'info' => $faker->text(random_int(20, 100)),
        'picies_in_set' => $faker->numberBetween(1, 5),
        'buying_price' => $buying_price,
        'cost' => $cost,
        'tax_rate' => 0.18,
        'fixed_selling_price' => $cost * $faker->randomFloat(2, 1.1, 2),
        'stock' => $faker->numberBetween(0, 200),
        'minimal_stock' => $faker->numberBetween(2, 10),
        'maximal_stock' => $faker->numberBetween(2, 10),
        'active' => $faker->randomElement(['TRUE', 'FALSE']),
        'public' => $faker->randomElement(['TRUE', 'FALSE']),

        'supplier_id' => $supplier_id,
        'category_id' => $category_id,

    ];
});
