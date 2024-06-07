<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard(): Response
    {
        $tasks = Task::query()
            ->where('user_id', auth()->id())
            ->get();

        return Inertia::render('Dashboard', ['tasks' => $tasks]);
    }
}
