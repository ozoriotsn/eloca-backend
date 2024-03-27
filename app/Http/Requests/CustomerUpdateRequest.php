<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CustomerUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [

            'empresa' => ['required', 'numeric', 'between:-9999,9999'],
            'codigo' => ['required', 'numeric', 'between:-99999999999999,99999999999999'],
            'razao_social' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'in:PJ,PF'],
            'cpf_cnpj' => ['required', 'string', 'max:14'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));

    }

    public function messages()
    {
        return [
            'codigo.required' => 'Codigo is required',
            'empresa.required' => 'Title is required',
            'sigla.required' => 'Sigla is required',
            'razao_social.required' => 'Razão social is required',
            'tipo.required' => 'Tipo is required',
            'cpf_cnpj.required' => 'Cpf/Cnpj is required',
        ];

    }
}
