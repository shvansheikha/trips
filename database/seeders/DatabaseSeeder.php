<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'shvan sheikha',
            'email' => 'shvansheikha@gmail.com',
        ]);

        $this->call([
            TaskSeeder::class,
            DriverSeeder::class,
            TruckSeeder::class
        ]);
    }
}
