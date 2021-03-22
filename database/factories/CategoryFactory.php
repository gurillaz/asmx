<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        // $table->id();

        // $table->string('name')->unique();
        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


        // $table->timestamps();


        'name' => 'Category-'.$faker->colorName().$faker->randomDigit,


    ];
});
