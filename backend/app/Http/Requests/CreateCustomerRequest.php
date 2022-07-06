<?php

namespace App\Http\Requests;

use App\Models\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCustomerRequest extends FormRequest
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
                "string"
            ],
            "cpf" =>[
                "required",
                "string",
                "unique:customers,cpf"
            ],
            "gender_id" => [
                "required",
                "integer",
                Rule::in(Gender::all()->pluck('id')->toArray())
            ],
            "birthday" =>[
                "required",
                "date"
            ],
            "email" => [
                "required",
                "string"
            ],
            "phone" =>[
                "required",
                "string"
            ],
        ];
    }

    public function messages(): array {

        return [
            "required" => "Campo Obrigatório",
            "string" => "Inválido",
            "integer" => "Inválido",
            "date" => "Inválido",
            "in" => "Inválido",
            "unique"=> "CPF já cadastrado"
        ];
    }
}
