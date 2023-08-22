<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterFundsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:5',
            'manager_id' => 'nullable',
            'year' => 'nullable|integer|min:1990|max:' . now()->year,
        ];
    }
}
