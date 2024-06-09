<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Driver;
use App\Models\Task;
use App\Models\Trip;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class TripController extends Controller
{
    public function showFrom(): Response
    {
        /* @var User $user */
        $user = auth()->user();

        $drivers = Driver::query()->where('user_id', $user->id)->get();
        $trucks = Truck::query()->where('user_id', $user->id)->get();
        $tasks = Task::query()
            ->where('user_id', $user->id)
            ->whereNull('trip_id')
            ->get();

        return Inertia::render('Trip/Store', [
            'drivers' => $drivers,
            'trucks' => $trucks,
            'tasks' => $tasks
        ]);
    }

    public function store(StoreTripRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $validated = $request->validated();

        $trip = Trip::query()->create(array_merge(['user_id' => auth()->id()], $validated));

        Task::query()->whereIn('id', $validated['tasks_id'])
            ->update(['trip_id' => $trip->id]);

        return redirect(route('dashboard'));
    }
}
