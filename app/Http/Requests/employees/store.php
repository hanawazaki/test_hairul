<?php

namespace App\Http\Requests\employees;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => 'required',
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'incentive' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
