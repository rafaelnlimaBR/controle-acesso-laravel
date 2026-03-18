<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostagemImagem extends Model
{
    protected $table = 'imagens_posts';

    public $timestamps = true;

    public function postagem()
    {
        return $this->belongsToMany(Postagem::class, 'postagens_imagens', 'imagem_id', 'postagem_id');
    }
}
