<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Task;
use App\Models\Trip;
use App\Models\Truck;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard(): Response
    {
        /* @var User $user */
        $user = auth()->user();

        $tasks = Task::query()
            ->with('trip')
            ->where('user_id', $user->id)
            ->get();

        $trips = Trip::query()
            ->with(['driver', 'truck', 'tasks'])
            ->where('user_id', $user->id)
            ->get();

        $drivers = Driver::query()->where('user_id', $user->id)->get();
        $trucks = Truck::query()->where('user_id', $user->id)->get();

        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
            'trips' => $trips,
            'drivers' => $drivers,
            'trucks' => $trucks,
        ]);
    }
}
