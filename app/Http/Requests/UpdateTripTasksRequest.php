<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTripTasksRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tasks_id' => ['array'],
            'tasks_id.*' => ['integer',
                Rule::exists('tasks', 'id')
                    ->where(function ($query) {
                        $query->where('user_id', auth()->id())
                            ->where(function ($query) {
                                $query->whereNull('trip_id')->orWhere('trip_id', $this->route('trip')->id);
                            });
                    })
            ]
        ];
    }
}
