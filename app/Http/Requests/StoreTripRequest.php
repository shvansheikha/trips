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
            'driver' => ['required', 'integer', 'exists:drivers,id'],
            'truck' => ['required', 'integer', 'exists:trucks,id'],
            'tasks' => ['required', 'array'],
            'tasks.*' => ['integer',
                Rule::exists('tasks', 'id')
                    ->where(fn($query) => $query->where('user_id', auth()->id())->whereNull('trip_id'))
            ]
        ];
    }
}
