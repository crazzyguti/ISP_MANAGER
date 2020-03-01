<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Location::class, function (Faker $faker) {
    $name = $faker->name();
    return [
            "name" => $name,
            "slug" => Str::slug($name),
            "centerlatlng" => $faker->latitude() . "," . $faker->longitude(),
    ];
});
