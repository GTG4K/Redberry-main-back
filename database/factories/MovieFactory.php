<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence(),
            'poster' => 'storage/img/movie/your_name.jpeg',
            'genre' => $this->faker->slug(),
            'release_date' => random_int(1990, 2023),
            'director' => $this->faker->name(),
        ];
    }
}
