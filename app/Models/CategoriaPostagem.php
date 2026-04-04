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

    public function ultimasPostagens($quantidade = 6)
    {
        return $this->postagens()->orderBy('created_at','desc')->take($quantidade);
    }

    public function maisVisualizada()
    {
        return $this->postagens()->orderBy('visualizacoes','desc')->first();
    }

    public function postagensMaisVisualizadas($quantidate = 5)
    {
        return $this->postagens()->orderBy('visualizacoes','desc')->take($quantidate)->get();
    }

    public function gravar($nome,$link,$meta_descricao, $meta_keywords,$ativo)
    {
        $this->nome         =   $nome;
        $this->nome_link  =   $link;
        $this->ativo        =   $ativo;
        $this->meta_descricao   =   strtolower($meta_descricao);
        $this->meta_keywords    =   strtolower($meta_keywords);
        $this->save();

    }
}
