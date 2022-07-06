<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    public $product_id;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->product_id = $this->route('product_id');

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
                "unique:products,name,".$this->product_id
            ],
            "description" => [
                "nullable",
                "string"
            ],
            "amount" => [
                "required",
                "integer"
            ],
            "price" => [
                "required",
                "numeric"
            ],
        ];
    }

    public function messages(): array {

        return [
            "required" => "Campo Obrigatório",
            "string" => "Inválido",
            "integer" => "Inválido",
            "numeric" => "Inválido",
            "unique" => "Produto já cadastrado"
        ];
    }
}
