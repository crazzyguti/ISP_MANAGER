<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Category::class, function (Faker $faker) {
    $slug = $faker->unique()->word;
    static $parent = 1;
    //$parent  = App\Category::all()->last()->id ?? 1;
    //$parent  = Category::inRandomOrder()->first()->id;
    return [
        'name' => $slug,
        'slug' => Str::slug($slug),
        'parent' => $parent++,
        "description" => $faker->text(),
    ];
});
