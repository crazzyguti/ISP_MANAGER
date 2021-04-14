<?php

namespace Database\Seeders;

// use App\Models\Category;
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
            RolesAndPermissionsSeeder::class,
            LocationTableSeeder::class,
            UserTableSeeder::class,
            // CommentSeeder::class,
            // ZoroSeeder::class
        ]);
        Model::reguard();



        // $this->call(Category::class);
        // // $this->call(RolesAndPermissionsSeeder::class);
        // $this->call(LocationTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        // // FakeSubscriber::factory(150)->create();

        // dd($this);
    }

    
}


