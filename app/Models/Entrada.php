<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Entrada extends Model
{
    protected $table = 'entradas';

    public function taxa()
    {
        return $this->belongsTo(TaxaEntrada::class, 'taxa_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function gravar(String $descricao, $valor_cliente, $valor_loja, $valor_original, $repassar_taxa, $data, User $autor, TaxaEntrada $taxa)
    {
        $this->descricao            = $descricao;
        $this->valor_cliente        = $valor_cliente;
        $this->valor_loja           = $valor_loja;
        $this->valor_original       = $valor_original;
        $this->repassar_taxa        = $repassar_taxa;
        $this->data                 = Carbon::createFromFormat('d/m/Y', $data);
        $this->autor()->associate($autor);
        $this->taxa()->associate($taxa);

        $this->save();
    }
}
