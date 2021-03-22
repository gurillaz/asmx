<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [

        // $table->id();
        // $table->string('name');
        // $table->string('bank_account_no')->nullable();
        // $table->string('bank_name')->nullable();
        // $table->string('fiscal_no')->nullable();
        // $table->string('address')->nullable();
        // $table->string('city')->nullable();
        // $table->string('postal_code')->nullable();
        // $table->string('country')->nullable();

        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

        // $table->timestamps();


        'name' => $faker->company,
        'bank_account_no' => $faker->bankAccountNumber,
        'bank_name' => $faker->company,
        'fiscal_no' => $faker->creditCardNumber(),
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,

    ];
});
