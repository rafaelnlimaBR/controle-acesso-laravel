<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Types\Relations\Car;
use mysql_xdevapi\Exception;

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
        return $this->belongsToMany('App\Models\Status','historicos','contrato_id','status_id')->withPivot('descricao','data','autor_id')->withTimestamps();
    }

    public function scopePesquisarPorVeiculo($query, $placa)
    {
        return $query->whereHas('veiculo', function($query) use ($placa){
            $query->where('placa', 'like','%'.$placa.'%');
        });
    }

    public function scopePesquisarPorData($query, $data)
    {
        if(is_null($data)){
            return $query;
        }
        $data   =   Carbon::parse($data)->format('Y-m-d');
        return $query->whereDate('data_inicio','like','%'.$data.'%');
    }

    public function scopePesquisarPorCliente($query,$cliente)
    {
        if(is_numeric($cliente)) {
            return $query->whereHas('cliente', function($query) use($cliente){
                 $query->whereHas('contatos', function($query) use($cliente){
                    $query->where('numero', 'like','%'.$cliente.'%');
                });
            });
        }else{
            return $query->whereHas('cliente', function($query) use($cliente){
                return $query->where('name','LIKE',"%$cliente%");
            });
        }
    }

    public function valorLiquidoTotalServico()
    {
        return $this->historicos->map->servicos->flatten()->sum('pivot.valor_liquido');
    }

    public function valorLiquidoTotalAutorizadoServico()
    {
        $valor  =   0;
        foreach ($this->historicos->map->servicos->flatten() as $servico) {
            if($servico->pivot->cobrar == 1){
                $valor  += $servico->pivot->valor_liquido;
            }
        }

        return $valor;
    }
    public function valorBrutoTotalServico()
    {
        return $this->historicos->map->servicos->flatten()->sum('pivot.valor_bruto');
    }

    public function valorLiquidoTotalPecaAvulsa()
    {
        $valorLiquidoTotal      =   0;

        foreach ($this->historicos->map->pecasavulsas->flatten() as $pecaavulsa) {
            $valorLiquidoTotal += $pecaavulsa->valor_liquido*$pecaavulsa->qnt;
        }
        return $valorLiquidoTotal;
    }

    public function valorLiquidoTotalAutorizadoPecaAvulsa()
    {

        $valorLiquidoTotal      =   0;

        foreach ($this->historicos->map->pecasavulsas->flatten() as $pecaavulsa) {
            if($pecaavulsa->cobrar == 1){
                $valorLiquidoTotal  += $pecaavulsa->valor_liquido*$pecaavulsa->qnt;
            }

        }
        return $valorLiquidoTotal;
    }
    public function valorBrutoTotalPecaAvulsa()
    {
        $valorLiquidoTotal      =   0;

        foreach ($this->historicos->map->pecasavulsas->flatten() as $pecaavulsa) {
            $valorLiquidoTotal += $pecaavulsa->valor_bruto*$pecaavulsa->qnt;
        }
        return $valorLiquidoTotal;
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
        $this->data_inicio              =   Carbon::createFromFormat('d/m/Y',$r->get('data_inicio'));
        if ($r->get('data_garantia')) {
            $this->data_garantia            =   Carbon::createFromFormat('d/m/Y',$r->get('data_garantia'));
        }

        $this->autor()->associate(auth()->user());
        $this->tecnico()->associate($r->get('tecnico'));

        $this->save();
        return $this;
    }

    public function excluir()
    {
        foreach ($this->historicos as $historico) {
            foreach ($historico->registros as $registro) {
                $registro->excluir();
            }
            foreach ($historico->entradas as $entrada) {
                $entrada->excluir();
            }
        }
        $this->delete();
    }
}
