<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function availableTasks(Request $request): JsonResponse
    {
        $tripId = $request->query('trip');
        $notSelectedTasks = Task::query()
            ->where('user_id', auth()->id())
            ->where(function (Builder $query) use ($tripId) {
                $query->whereNull('trip_id')
                    ->orWhere('trip_id', $tripId);
            })
            ->get();

        return response()->json($notSelectedTasks);
    }
}
