<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->name();
        return [
            "name" => $name,
            "slug" => Str::slug($name),
            "centerlatlng" => $this->faker->latitude() . "," . $this->faker->longitude(),
        ];
    }
}