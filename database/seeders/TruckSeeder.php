<?php

namespace Database\Seeders;

use App\Models\Truck;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::query()
            ->where('email', 'shvansheikha@gmail.com')
            ->first();

        Truck::factory()
            ->count(10)
            ->for($user)
            ->create();
    }
}
