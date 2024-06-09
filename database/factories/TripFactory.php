<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trip>
 */
class TripFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => fake()->words(rand(1, 2), true),
            'body' => fake()->sentences(rand(2, 4), true)
        ];
    }
}
