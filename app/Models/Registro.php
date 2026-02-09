<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';

    public function tipo()
    {
        return $this->belongsTo(TipoRegistro::class,'tipo_id');
    }

    public function imagens()
    {
        return $this->hasMany(ImagemRegistro::class,'registro_id');
    }
}
