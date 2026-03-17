<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Registro extends Model
{
    protected $table = 'registros';

    public function tipo()
    {
        return $this->belongsTo(TipoRegistro::class,'tipo_id');
    }

    public function imagens()
    {
        return $this->hasMany(RegistroImagem::class,'registro_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class,'autor_id');
    }

    public function historico()
    {
        return $this->belongsTo(Historico::class,'historico_id');
    }

    public function gravar($data, $descricao, $tipo, $historico, $autor=null)
    {

        $this->data         =   Carbon::createFromFormat('d/m/Y',$data);
        $this->descricao    =   $descricao;
        $this->tipo()->associate($tipo);
        $this->historico()->associate($historico);

        $this->autor()->associate($autor);

        $this->save();
    }

    public function excluir()
    {

        foreach ($this->imagens as $imagem) {
            $imagem->excluir();
        }
        $this->delete();
    }

}
