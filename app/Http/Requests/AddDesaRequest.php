<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDesaRequest extends FormRequest
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
            'id' => 'nullable|numeric',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:50',
            'code' => 'required|numeric|unique:indonesia_villages,code|max_digits:10',
            'district_code' => 'required|numeric|max_digits:7',
            'meta' => 'nullable'
        ];
    }
}
