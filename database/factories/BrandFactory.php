<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        // $table->id();

        // $table->string('name');
        // $table->string('producing_company')->nullable();
        // $table->string('producing_country');
        // $table->enum('public',[TRUE,FALSE]);
        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


        // $table->timestamps();


        'name' => $faker->name(),
        'producing_company' => $faker->company,
        'producing_country' => $faker->country,


    ];
});
