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

    protected $fillable = ['id'];

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
        return $this->belongsToMany('App\Models\Status','historicos','contrato_id','status_id')->withPivot('descricao','data','autor_id','id')->withTimestamps();
    }

    public function scopePesquisarPorId($query, $id = null)
    {
        if($id != null){
            return $query->where('id','like', '%'.$id.'%');
        }
       return $query;
    }
    public function scopePesquisarPorVeiculo($query, $placa)
    {
        if($placa == null){
            return $query;
        }
        if($placa == ""){
            return $query;
        }
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

    public function valorBrutoTotalServicoAutorizado()
    {
        $valor  =   0;
        foreach ($this->historicos->map->servicos->flatten() as $servico) {
            if($servico->pivot->cobrar == 1){
                $valor  += $servico->pivot->valor_bruto;
            }
        }

        return $valor;
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

    public function situacaoPagamento()
    {
        return $this->valorTotalLiquidoAutorizado() == $this->valorTotalPago();
    }

    public function valorTotalLiquidoAutorizado()
    {
        return $this->valorLiquidoTotalAutorizadoServico()+$this->valorLiquidoTotalAutorizadoPecaAvulsa();
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

    public function valorBrutoTotalAutorizadoPecaAvulsa()
    {

        $valorLiquidoTotal      =   0;

        foreach ($this->historicos->map->pecasavulsas->flatten() as $pecaavulsa) {
            if($pecaavulsa->cobrar == 1){
                $valorLiquidoTotal  += $pecaavulsa->valor_bruto*$pecaavulsa->qnt;
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

    public function valorTotalPago()
    {
        return $this->historicos->map->entradas->flatten()->sum('valor_original');
    }

    public function cobrarServicos($cobrar)
    {
        foreach ($this->historicos->map->servicos->flatten() as $servico) {
            $servico->pivot->cobrar = $cobrar;
            $servico->pivot->save();
        }
    }

    public function cobrarPecasAvulsas($cobrar)
    {
        foreach ($this->historicos->map->pecasAvulsas->flatten() as $pecas) {
            $pecas->cobrar = $cobrar;
            $pecas->save();
        }
    }



    public function gravar(User $cliente,$data_inicio, $descricao_cliente, Veiculo $veiculo=null,$observacao=null,$solucao=null,User $autor=null, User $tecnico=null  )
    {
        $this->cliente()->associate($cliente);
        if($veiculo != null){
            $this->veiculo()->associate($veiculo);
        }
        $this->descricao_cliente        =   $descricao_cliente;
        $this->observacao               =   $observacao;
        $this->solucao                  =   $observacao;
        $this->data_inicio              =   Carbon::createFromFormat('d/m/Y',$data_inicio);
        $this->data_garantia            =  null;

        if($autor != null){
            $this->autor()->associate(auth()->user());
        }
        if($tecnico != null){
            $this->tecnico()->associate($tecnico);
        }
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
