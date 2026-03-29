<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Historico extends Model
{
    protected $table = 'historicos';


    public function entradas()
    {
        return $this->belongsToMany(Entrada::class, 'historico_entrada', 'historico_id', 'entrada_id');
    }
    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function indicacoes()
    {
        return $this->hasMany(Indicacao::class,'historico_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function autor()
    {
        return $this->belongsTo(User::class,'autor_id');
    }

    public function registros()
    {
        return $this->hasMany(Registro::class,'historico_id');
    }

    public function servicos()
    {
        return$this->belongsToMany(Servico::class,'historico_servico','historico_id','servico_id')->withPivot('valor_bruto','valor_liquido','desconto','devolucao','cobrar','id')->withTimestamps();
    }

    public function pecasAvulsas()
    {
        return $this->hasMany(PecaAvulsa::class,'historico_id');
    }

    public function gravar(Request $r)
    {

        $this->descricao        = $r->get('descricao');
        $this->data             = Carbon::createFromFormat('d/m/Y',$r->get('data'));

        $this->save();
    }


}
