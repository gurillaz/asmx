<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InvoiceMessage;
use Faker\Generator as Faker;

$factory->define(InvoiceMessage::class, function (Faker $faker) {
    return [
        'text' => 'Message-'.$faker->colorName().$faker->randomDigit.$faker->sentence(20),
    ];
});
