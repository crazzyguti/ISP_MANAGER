<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $slug = $this->faker->unique()->word;
        static $parent = 1;
        return [
            'name' => $slug,
            'slug' => Str::slug($slug),
            'parent' => $parent++,
            "description" => $this->faker->text(),
        ];
    }
}

