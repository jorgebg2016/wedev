<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            "customer_id" => [
                "required",
                "integer",
                Rule::in(Customer::all()->pluck('id')->toArray())
            ],
            "product_id" => [
                "required",
                "integer",
                Rule::in(Product::all()->pluck('id')->toArray())
            ],
            "quantity" => [
                "required",
                "integer",
                "gte:1",
            ],
        ];
    }

    public function messages(): array 
    {
        return [
            "required" => "Campo Obrigatório",
            "integer" => "Inválido",
            "in" => "Inválido",
            "gte" => "Inválido",
        ];
    }
}
