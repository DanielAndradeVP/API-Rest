<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
                'nullable',
                'max:50',
                'min:3',
                'string',
                'unique:products,name',
            ],
            'description' => [
                'nullable',
                'string',
                'min:5',
                'max:100',
            ],
            'price' => [
                'nullable',
                'int',
            ],
        ];
    }

    public function messages()
    {

        return [
            'name.unique' => 'The name is already in use',
            'name.min' => 'The minimum characters is 3',
            'name.max' => 'the maximum characters is 50',
            'price.int' => 'the price must be intereger',
            'description.min' => 'the description have a minimum caracters ',
        ];
    }
}
