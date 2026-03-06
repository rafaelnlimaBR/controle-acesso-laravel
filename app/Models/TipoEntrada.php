<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEntrada extends Model
{
    protected $table = 'tipos_entradas';

    public function scopeAtivo($query)
    {
        return $query->where('ativo',1)->get();
    }

    public function taxas()
    {
        return $this->hasMany(TaxaEntrada::class,'tipo_id');
    }
}
