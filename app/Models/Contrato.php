<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Types\Relations\Car;

class Contrato extends Model
{
    protected $table = 'contratos';

    public function cliente()
    {
        return $this->belongsTo('App\Models\User','cliente_id');
    }

    public function veiculo()
    {
        return $this->belongsTo('App\Models\Veiculo','veiculo_id');
    }

    public function historicos(){
        return $this->hasMany(Historico::class);
    }

    public function autor()
    {
        return $this->belongsTo('App\Models\User','criador_id');
    }

    public function tecnico()
    {
        return $this->belongsTo('App\Models\User','tecnico_id');
    }

    public function status()
    {
        return $this->belongsToMany('App\Models\Status','historicos','contrato_id','status_id')->withPivot('descricao','data')->withTimestamps();
    }

    public function gravar(Request $r)
    {
        $this->cliente()->associate($r->get('cliente'));
        if($r->has('veiculo')){
            $this->veiculo()->associate($r->get('veiculo'));
        }
        $this->descricao_cliente        =   $r->get('descricao');
        $this->observacao               =   $r->get('observacao');
        $this->solucao                  =   $r->get('solucao');
        $this->data_inicio              =   Carbon::parse($r->get('data_inicio'))->format('Y-m-d');
        $this->data_garantia            =   Carbon::parse($r->get('data_garantia'))->format('Y-m-d');
        $this->autor()->associate(auth()->user());
        $this->tecnico()->associate($r->get('tecnico'));

        $this->save();
        return $this;
    }
}
