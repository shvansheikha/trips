<?php

namespace Database\Factories;

use App\Models\Truck;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Truck>
 */
class TruckFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fn() => User::factory()->create()->id,
            'title' => fake()->name
        ];
    }
}
