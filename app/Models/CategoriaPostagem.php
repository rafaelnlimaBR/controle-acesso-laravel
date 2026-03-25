<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaPostagem extends Model
{
    protected $table = 'categorias';
    public $timestamps = false;

    public function postagens()
    {
        return $this->belongsToMany(Postagem::class, 'categoria_postagem', 'categoria_id', 'postagem_id');
    }

    public function scopePesquisarPorNome($query, $nome)
    {
        return $query->where('nome','like','%'.$nome.'%');
    }

    public function scopePesquisarPorStatus($query,$status)
    {
        return $query->where('ativo',$status);
    }

    public function gravar($nome,$link,$ativo)
    {
        $this->nome         =   $nome;
        $this->nome_link  =   $link;
        $this->ativo        =   $ativo;
        $this->save();

    }
}
