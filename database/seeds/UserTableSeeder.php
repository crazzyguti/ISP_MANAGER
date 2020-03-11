<?php

use App\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$admin = Role::where('name', 'admin')->first();
        $today = Carbon::today()->addDay(rand(1,100));
        $user = [
            "firstName" => "Gultekin",
            "lastName" => "Ahmed",
            "email_phone" => "manyaka_88@abv.bg",
            "gender" => "male",
            "birthday" => "1988-10-17",
            'expires_at' => $today,
            "password" => Hash::make("password"),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
        $user =  User::create($user);
        $user->assignRole('super-admin');
    }
}