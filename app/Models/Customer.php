<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recnum',
        'empresa',
        'codigo',
        'razao_social',
        'tipo',
        'cpf_cnpj',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'recnum' => 'integer',
        'empresa' => 'decimal:0',
        'codigo' => 'decimal:0',
    ];

    public function empresaData(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'empresa', 'codigo');
    }
}
