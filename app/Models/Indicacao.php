<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    protected $table = 'indicacoes';
    protected $primaryKey = 'id';

    public function historico()
    {
        return $this->belongsTo(Historico::class,'historico_id');
    }

    public function fornecedor()
    {
        return $this->belongsTo(User::class,'fornecedor_id');
    }

    public function saidas()
    {
        return $this->belongsToMany(Saida::class,'indicacao_saida','indicacao_id','saida_id');
    }

    public function gravar($fornecedor,$historico,$descricao,$valor, $data)
    {
        $this->descricao    = $descricao;
        $this->valor        = $valor;
        $this->data         = Carbon::createFromFormat('d/m/Y',$data);
        $this->historico()->associate($historico);
        $this->fornecedor()->associate($fornecedor);

        $this->save();

    }

    public function excluir()
    {
        $this->delete();
    }
}
