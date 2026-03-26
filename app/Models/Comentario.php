<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';

    public function autor()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function postagens()
    {
        return $this->belongsToMany(Postagem::class, 'comentario_postagem', 'comentario_id', 'postagem_id');
    }

    public function respostas()
    {
        return $this->belongsToMany(Comentario::class, 'comentario_resposta', 'comentario_id', 'resposta_id');
    }

    public function scopePesquisarPorStatus($query, $status)
    {
        return $query->where('ativo', $status);
    }

    public function salvar($conteudo, User $autor = null, $ativo=null,)
    {
        $this->conteudo         =   $conteudo;
        if($autor!=null){
            $this->autor()->associate($autor);
        }

        $this->ativo            =   $ativo;

        $this->save();
    }
}
