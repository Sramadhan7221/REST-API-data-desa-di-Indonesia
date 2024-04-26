<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetDesaRequest extends FormRequest
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
            'province_code' => 'nullable|numeric',
            'city_code' => 'nullable|numeric',
            'district_code' => 'nullable|numeric',
            'keyword' => 'nullable|alpha:ascii|min:3|max:50',
            'page' => 'nullable|numeric',
            'size' => 'nullable|numeric'
        ];
    }
}
