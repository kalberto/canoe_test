<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class FundRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:20'],
            'manager_id' => ['required', 'exists:fund_managers,id'],
            'start_year' => ['required', 'integer', 'min:1990', 'max:'.Carbon::now()->year],
            'aliases' => ['array', 'nullable'],
            'aliases.*' => ['required', 'string', 'min:5', 'max:20'],
            'companies' => ['array', 'nullable'],
            'companies.*' => ['required', 'exists:companies,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
