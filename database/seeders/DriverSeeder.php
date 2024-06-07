<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->where('email', 'shvansheikha@gmail.com')
            ->first();

        Driver::factory()
            ->count(10)
            ->for($user)
            ->create();
    }
}
