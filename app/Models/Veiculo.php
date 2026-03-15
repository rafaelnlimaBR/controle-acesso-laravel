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
        if($placa == ""){
            return $query;
        }else{

            return $query->where('placa','like','%'.$placa.'%');
        }
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

    public function gravar($placa, $cor, $ano, $modelo_id)
    {
        $this->placa            =   strtoupper($placa);
        $this->cor              =   strtolower($cor);
        $this->ano              =   strtoupper($ano);
        $this->modelo_id         =   strtoupper($modelo_id);
        $this->save();


    }


}
