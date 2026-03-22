<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEntrada extends Model
{
    protected $table = 'tipos_entradas';
    public $timestamps = false;

    public function scopeAtivo($query)
    {
        return $query->where('ativo',1)->get();
    }

    public function taxas()
    {
        return $this->hasMany(TaxaEntrada::class,'tipo_id');
    }

    public function scopePesquisarPorNome($query,$nome)
    {
        return $query->where('nome','LIKE',"%$nome%");
    }

    public function gravar($nome, $pix, $ativo)
    {
        $this->nome = $nome;
        $this->pix = $pix;
        $this->ativo = $ativo;

        $this->save();
    }

    public function excluir()
    {
        $this->delete();
    }
}
