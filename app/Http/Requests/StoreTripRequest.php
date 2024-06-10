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
            'truck' => ['required', 'integer', 'exists:trucks,id']
        ];
    }
}
