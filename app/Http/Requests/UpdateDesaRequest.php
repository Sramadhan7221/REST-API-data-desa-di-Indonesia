<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDesaRequest extends FormRequest
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
            'name' => 'nullable|regex:/^[a-zA-Z\s]+$/|max:50',
            'code' => 'nullable|numeric|unique:indonesia_villages,code|max_digits:10',
            'district_code' => 'nullable|numeric|max_digits:7',
            'meta' => 'nullable'
        ];
    }
}
