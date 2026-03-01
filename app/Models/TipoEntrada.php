<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEntrada extends Model
{
    protected $table = 'tipos_entradas';

    public function taxas()
    {
        return $this->hasMany(TaxaEntrada::class,'tipo_id');
    }
}
