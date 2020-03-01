<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Marker;
use Faker\Generator as Faker;

$factory->define(Marker::class, function (Faker $faker) {
    return [
        'name' => $faker->cityPrefix,
        'address' => $faker->address,
        'lat' => $faker->latitude(),
        'lgn' => $faker->longitude(),
        'type' => $faker->firstName(),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});


