<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTripRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'body' => ['nullable', 'string', 'min:3'],
            'driver_id' => ['required', 'integer', 'exists:drivers,id'],
            'truck_id' => ['required', 'integer', 'exists:trucks,id'],
            'tasks_id' => ['required', 'array'],
            'tasks_id.*' => ['integer',
                Rule::exists('tasks', 'id')
                    ->where(fn($query) => $query->where('user_id', auth()->id())->whereNull('trip_id'))
            ]
        ];
    }
}
