<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Montadora extends Model
{
    protected $table = 'montadoras';
    public $timestamps = false;
    public function scopePesquisarPorNome($query, $nome)
    {
        return $query->where('nome', 'LIKE', "%$nome%");
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }

    public function gravar($nome)
    {
        $this->nome      = strtoupper($nome);
        $this->save();
    }

    public function excluir()
    {
        $this->delete();
    }
}
