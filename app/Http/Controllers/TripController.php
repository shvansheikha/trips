<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripTasksRequest;
use App\Models\Task;
use App\Models\Trip;
use Inertia\Inertia;

class TripController extends Controller
{
    public function store(StoreTripRequest $request)
    {
        $validated = $request->validated();

        Trip::query()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => auth()->id(),
            'driver_id' => $validated['driver'],
            'truck_id' => $validated['truck']
        ]);

        return Inertia::location(route('dashboard'));
    }

    public function updateTasks(Trip $trip, UpdateTripTasksRequest $request)
    {
        $validated = $request->validated();

        Task::query()
            ->where('trip_id', $trip->id)
            ->update(['trip_id' => null]);

        if ($validated['tasks_id']) {
            Task::query()
                ->whereIn('id', $request->validated('tasks_id'))
                ->update(['trip_id' => $trip->id]);
        }

        return response()->json(['message' => 'success']);
    }
}
