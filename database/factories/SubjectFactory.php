<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [






        'name' => $faker->company,
        'bank_account_no' => $faker->bankAccountNumber,
        'bank_name' => $faker->company,
        'fiscal_no' => $faker->creditCardNumber(),
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,

        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone_1' => $faker->phoneNumber,
        'phone_2' => $faker->phoneNumber,
        'email' => $faker->email,
        'website' => $faker->url,
        'info' => $faker->text(50),

        'subject_type' => $faker->randomElement(['client', 'supplier']),


        'credit_limit' => $faker->numberBetween(0,999),
        'payment_limit_days' => $faker->numberBetween(0,30),
        'price_increase_quota' => $faker->randomFloat(2,1,2),

    ];
});
