<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        // $table->id();
        // $table->string('first_name');
        // $table->string('last_name');
        // $table->string('phone_1');
        // $table->string('phone_2')->nullable();
        // $table->string('email')->nullable();
        // $table->string('client_type')->nullable();
        // $table->unsignedInteger('credit_limit');
        // $table->unsignedInteger('payment_limit_days');
        // $table->unsignedDouble('price_increase_quota')->default('1');

        // $table->unsignedBigInteger('price_level_id');
        // $table->unsignedBigInteger('subject_id');
        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


        // $table->foreign('price_level_id')->references('id')->on('price_levels')->onUpdate('cascade');
        // $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade');
        // $table->timestamps();


        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'phone_1' => $faker->phoneNumber,
        'phone_2' => $faker->phoneNumber,
        'email' => $faker->email,
        'client_type' => $faker->word(),
        'credit_limit' => $faker->numberBetween(0,999),
        'payment_limit_days' => $faker->numberBetween(0,30),
        'price_increase_quota' => $faker->randomFloat(2,1,2),

    ];

});
