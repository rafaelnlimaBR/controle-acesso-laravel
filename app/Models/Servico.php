<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servicos';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'nome'];

    public $timestamps = false;

    public function scopePesquisarPorNome($query, $nome){
        return $query->where('nome','like','%'.$nome.'%');
    }

    public function gravar($descricao, $valor)
    {
        $this->nome        =   strtoupper($descricao);
        $this->valor            =   $valor;

        $this->save();
    }

    public function excluir()
    {
        $this->delete();
    }

}
