<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Validator;

class Contato extends Model
{
    protected $table = 'contatos';
    protected $fillable =   ['numero'];
    private static $regras = [
        'numero'          =>  'required|min:10|max:11',
    ];

    public static function validacao($dados)
    {
        return Validator::make($dados,self::$regras);
    }

    public function gravar(String $numero)
    {
        $contato    =   Contato::firstOrCreate(['numero' =>  $numero]);

        return $contato;

    }
}
