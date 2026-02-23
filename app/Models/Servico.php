<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servicos';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'nome'];

    public function scopePesquisarPorNome($query, $nome){
        return $query->where('nome','like','%'.$nome.'%');
    }
}
