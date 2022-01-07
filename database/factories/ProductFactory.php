<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->realText(),
            'price' => rand(100, 999),
            'image' => "https://picsum.photos/600/400/?random",
            'created_by' => rand(1, 10),
            'created_at' => Carbon::now(),
        ];
    }
}
