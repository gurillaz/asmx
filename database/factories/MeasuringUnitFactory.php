<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MeasuringUnit;
use Faker\Generator as Faker;

$factory->define(MeasuringUnit::class, function (Faker $faker) {
    return [
        //

        'name' => 'Unit-'.$faker->colorName().$faker->randomDigit,
        'info' => $faker->words(15,true),

    ];
});
