<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Grupo extends Model
{
    protected $table = 'grupos';

    public function scopePesquisarPorNome($query, $nome)
    {
        return $query->where('nome','like','%'.$nome.'%');
    }

    public function scopeVisiveis($query)
    {
        return $query->where('visivel',true);
    }

    public static function validacao($dados, $id = null)
    {
        $regras =   [
            'nome'          =>  'required|min:3|max:100|unique:App\Models\Grupo,nome'.(is_null($id) ? '' : ",$id"),
        ];

        return Validator::make($dados, $regras);


    }



    public function usuarios()
    {
        return $this->belongsToMany('App\Models\User', 'user_grupo', 'grupo_id', 'user_id');
    }

    public function permissoes()
    {
        return $this->belongsToMany('App\Models\Permissao', 'grupo_permissao', 'grupo_id', 'permissao_id');
    }

    public function gravar(Request $r)
    {
        $this->nome             =   strtoupper($r->get('nome'));

        $this->save();
        $this->permissoes()->sync($r->input('permissoes'));

    }
}
