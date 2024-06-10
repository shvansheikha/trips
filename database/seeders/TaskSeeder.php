<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->where('email', 'shvansheikha@gmail.com')
            ->first();

        Task::factory()
            ->count(50)
            ->for($user)
            ->sequence(fn($sequence) => ['title' => "task #" . $sequence->index + 1])
            ->create();
    }
}
