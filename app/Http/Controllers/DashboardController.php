<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Trip;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard(): Response
    {
        $tasks = Task::query()
            ->with('trip')
            ->where('user_id', auth()->id())
            ->get();

        $trips = Trip::query()
            ->with(['driver', 'truck', 'tasks'])
            ->where('user_id', auth()->id())
            ->get();

        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
            'trips' => $trips
        ]);
    }
}
