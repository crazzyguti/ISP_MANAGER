<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use Illuminate\Support\Str;

class LocationTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $villages = ["Габерово", "Бата", "Гълъбец", "Белодол", "Разбойна", "Рожден", "Руен", "Рудина", "Ръжица", "Косовец", "Преображенци", "Припек", "Просеник", "Мрежичко", "Подгорец", "Медово", "Средна_махала", "Сини рид", "Страцин", "Топчийско", "Дъбник", "Черна могила"];
        foreach ($villages as $village) {

            $faker = \Faker\Factory::create();

            $location = new Location();
            $location->name = $village;
            $location->slug = Str::slug($village);
            $location->centerlatlng = $faker->latitude . "," . $faker->longitude;
            $location->save();
        }
    }
}
