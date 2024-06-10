<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Task;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TripController extends Controller
{
    public function store(StoreTripRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $trip = Trip::query()->create([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'user_id' => auth()->id(),
                'driver_id' => $validated['driver'],
                'truck_id' => $validated['truck']
            ]);

            Task::whereIn('id', $validated['tasks'])->update(['trip_id' => $trip->id]);
        });

        return Inertia::location(route('dashboard'));
    }
}
