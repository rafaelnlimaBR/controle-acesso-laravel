<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'modelos';

    public function montadora()
    {
        return $this->belongsTo(Montadora::class);
    }

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    public function scopePesquisarPorNome($scope, $nome)
    {
        return $scope->where('nome', 'like', '%' . $nome . '%');
    }
}
