<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PriceLevel;
use Faker\Generator as Faker;

$factory->define(PriceLevel::class, function (Faker $faker) {
    return [
        // $table->id();
        // $table->string('name')->unique();
        // $table->double('quota')->default(1);
        // $table->text('info');

        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

        // $table->timestamps();


        'name' => $faker->words(random_int(1,2),true),

        'quota' => $faker->randomFloat(2,1.1,2),
        'info' => $faker->text(100),
    ];
});
