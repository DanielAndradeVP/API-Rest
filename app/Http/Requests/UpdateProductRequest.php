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
                'max:50',
                'min:3',
                'string',
                'unique:products,name',
            ],
            'description' => [
                'string',
            ],
            'price' => [
                'int',
                'min_digits:1',
            ],
        ];
    }

    public function messages()
    {

        return [
            'name.max' => 'the maximum characters is 50',
            'name.min' => 'The minimum characters is 3',
            'name.string' => 'The name most be string',
            'name.unique' => 'The name is already in use',
            'description.min' => 'the description have a minimum 3 caracters',
            'description.max' => 'the description have a maximum 100 caracters ',
            'description.string' => 'the description must be string',
            'price.min_digits' => 'the minimum number of decimal places is 1',
            'price.int' => 'The price most be an intereger',
        ];
    }
}
