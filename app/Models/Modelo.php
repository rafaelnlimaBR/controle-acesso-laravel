<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'modelos';
    public $timestamps = false;

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

    public function scopePesquisarPorMontadora($scope, $montadora)
    {
        if($montadora == '0'){
            return $scope;
        }
        if ($montadora == null) {
            return $scope;
        }
        return $scope->whereHas('montadora', function ($query) use ($montadora) {
            return $query->where('montadora_id', $montadora);
        });
    }

    public function gravar($nome, $montadora)
    {
        $this->nome = strtoupper($nome);
        $this->montadora()->associate($montadora);
        $this->save();
    }

    public function excluir()
    {
        $this->delete();
    }
}
