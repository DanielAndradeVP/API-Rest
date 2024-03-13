<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'max:20',
                'min:3',
                'string',
                'unique:categories,name',
            ],
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'The name is required',
            'name.unique' => 'The name is already in use',
            'name.min' => 'The minimum characters is 3',
            'name.max' => 'the maximum characters is 20',
        ];
    }
}
