<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID' => $this->faker->unique(),
            'Country' => $this->faker->name(),
            'CountryCode' => $this->faker->name(),
            'Slug' => $this->faker->name(),
            'NewConfirmed' => Str::random(1000),
            'TotalConfirmed' => Str::random(2000),
            'NewDeaths' => Str::random(100),
            'TotalDeaths' => Str::random(100),
            'NewRecovered' => Str::random(100),
            'TotalRecovered' => Str::random(100),
            'Date' => $this->faker->dateTimeBetween('+0 days', '+2 years')
        ];
    }
}
