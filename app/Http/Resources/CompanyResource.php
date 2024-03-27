<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'codigo' => $this->codigo,
            'empresa' => $this->empresa,
            'sigla' => $this->sigla,
            'razao_social' => $this->razao_social,
        ];
    }
}
