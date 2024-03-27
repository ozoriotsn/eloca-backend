<?php

namespace App\Http\Resources;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'empresa' => $this->empresa,
            'codigo' => $this->codigo,
            'razao_social' => $this->razao_social,
            'tipo' => $this->tipo,
            'cpf_cnpj' => $this->cpf_cnpj,
            'empresa_data'=> Company::where('codigo', $this->empresa)->first(),
        ];
    }
}
