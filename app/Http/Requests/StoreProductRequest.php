<?php

namespace App\Http\Requests;

use App\Rules\StatusRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        // Campos obrigatórios
        return [
            'name' => [
                'required',
                'string',
                'unique:products,name',
                'min:3',
                'max:50',
            ],
            'description' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                'int',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
                'int',
                new StatusRule,
            ],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.string' => 'A name most be an string',
            'name.unique' => 'The name is already in use',
            'name.min' => 'The minimum characters is 3',
            'name.max' => 'the maximum characters is 50',
            'description.required' => 'the description is required',
            'description.string' => 'the description most be string',
            'price.required' => 'the price is required',
            'price.int' => 'the price must be intereger',
            'category_id.required' => 'the category_id is required',
            'category_id.int' => 'the category_id most be an int',
            'category_id.exists' => 'The category no exists',
            'status.required' => 'The category is not active',
        ];
    }
}
