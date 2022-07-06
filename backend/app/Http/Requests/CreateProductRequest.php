<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => [
                "required",
                "string",
                "unique:products,name"
            ],
            "description" => [
                "required",
                "unique:products,description",
                "string"
            ],
            "amount" => [
                "required",
                "integer",
                "gte:1"
            ],
            "price" => [
                "required",
                "numeric",
                "gte:0.01"
            ],
        ];
    }

    public function messages(): array {

        return [
            "required" => "Required Field",
            "string" => "Invalid",
            "integer" => "Invalid",
            "numeric" => "Invalid",
            "name.unique" => "Product already stored",
            "description.unique" => "Description already stored",
            "amount.gte" => "The min amount is 1",
            "price.gte" => "The min value is $ 0.01",
        ];
    }
}
