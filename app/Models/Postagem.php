<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    protected $table = 'postagens';

    public function imagens()
    {
        return $this->belongsToMany(PostagemImagem::class, 'postagens_imagens', 'postagem_id', 'imagem_id');
    }

    public function imagem()
    {
        return $this->belongsTo(PostagemImagem::class, 'imagem_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(CategoriaPostagem::class, 'categoria_postagem', 'postagem_id', 'categoria_id');
    }

    public function comentarios()
    {
        return $this->belongsToMany(Comentario::class, 'comentario_postagem', 'postagem_id', 'comentario_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function scopePesquisarPorTitulo($query, $titulo)
    {
        return $query->where('titulo','like','%'.$titulo.'%');
    }

    public function gravar($titulo, $link, $ativo, $conteudo, $meta,User $autor,$imagem=null)
    {
        $this->titulo           =   $titulo;
        $this->titulo_link      =   $link;
        $this->ativo            =   $ativo;
        $this->conteudo         =   $conteudo;
        $this->meta_descricao   =   $meta;

            $this->imagem()->associate($imagem);


        $this->autor()->associate($autor);

        $this->save();
    }

    public function excluir()
    {


        $this->delete();
    }
}
