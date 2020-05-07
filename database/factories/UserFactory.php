<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|

 */

$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male','female']);
    $email_phone = $faker->randomElement([$faker->unique()->safeEmail,$faker->unique()->e164PhoneNumber]);
    $today = Carbon::today()->addDay(rand(1,100));
    return [
        'firstName' => $faker->firstName($gender),
        'lastName' => $faker->lastName($gender),
        'email_phone' => $email_phone,
        "birthday" => $faker->date(),
        "gender" => $gender,
        'email_verified_at' => now(),
        'password' => Hash::make("secret"), // secret
        'remember_token' => Str::random(10),
        'locate' => "",
    ];
});

