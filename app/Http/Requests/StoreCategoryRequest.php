<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
                'string',
                'unique:categories,name',
                'min:3',
            ]];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.string' => 'the name most be string',
            'name.unique' => 'The name is already in use',
            'name.min' => 'The minimum characters is 3',
        ];
    }
}
