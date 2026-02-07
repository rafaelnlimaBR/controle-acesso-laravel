<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Veiculo extends Model
{
    protected $table = 'veiculos';

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function scopePesquisarPorPlaca($query, $placa)
    {

        return $query->where('placa','like','%'.$placa.'%');
    }

    public function scopePesquisarPorModelo($query, $modelo)
    {
        if($modelo > 0) {
            return $query->whereHas('modelo', function ($query) use ($modelo) {
                return $query->where('modelo_id', $modelo);
            });
        }else{
            return $query;
        }
    }

    public function gravar(Request $r)
    {
        $this->placa            =   strtoupper($r->get('placa'));
        $this->cor              =   strtolower($r->get('cor'));
        $this->ano              =   strtoupper($r->get('ano'));
        $this->modelo_id         =   strtoupper($r->get('modelo'));
        $this->save();


    }


}
