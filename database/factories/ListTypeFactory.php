<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ListType;
use Faker\Generator as Faker;

$factory->define(ListType::class, function (Faker $faker) {
    return [

        // $table->id();

        // $table->string('name')->unique();
        // $table->text('info')->nullable();
        // $table->enum('stock_type',['IN','OUT']);
        // $table->enum('public',[TRUE,FALSE]);

        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


        // $table->timestamps();

        'name' => 'LoistType-'.$faker->words(random_int(1,3),true).$faker->randomDigit,

        'info' => $faker->text(100),
        'stock_type' => $faker->randomElement(['IN','OUT']),
        'public' => $faker->randomElement(['TRUE','FALSE']),
    ];
});
