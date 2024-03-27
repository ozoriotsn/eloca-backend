<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class CompanyUpdateRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'codigo' => ['required', 'numeric'],
            'empresa' => ['required', 'numeric', 'between:-9999,9999'],
            'sigla' => ['required', 'string', 'max:40'],
            'razao_social' => ['required', 'string', 'max:255'],
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
        ];

    }
}
