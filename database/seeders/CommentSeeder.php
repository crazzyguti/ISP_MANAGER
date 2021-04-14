<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(5)
            ->hasPosts(1)
            ->create();
    }
}
