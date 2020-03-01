<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call([
            CategorySeeder::class,
            //RoleTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            LocationTableSeeder::class,
            UserTableSeeder::class,
        ]);
        Model::reguard();

    }
}


