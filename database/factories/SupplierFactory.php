<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        // $table->id();
        // $table->string('first_name');
        // $table->string('last_name');
        // $table->string('phone_1');
        // $table->string('phone_2')->nullable();
        // $table->string('email')->nullable();
        // $table->string('website')->nullable();
        // $table->text('info')->nullable();

        // $table->unsignedBigInteger('subject_id');
        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


        // $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade');
        // $table->timestamps();

        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone_1' => $faker->phoneNumber,
        'phone_2' => $faker->phoneNumber,
        'email' => $faker->email,
        'website' => $faker->url,
        'info' => $faker->text(50),

    ];
});
