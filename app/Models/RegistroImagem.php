<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class RegistroImagem extends Model
{
    protected $table = 'registros_imagens';

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

    public function gravar(Registro $registro,$image, $descricao ,)
    {


            if (!file_exists(public_path('/layout/imagens/registros/'))){
                mkdir(public_path('/layout/imagens/registros/'), 0777, true);
            }
            $filename="";
            $filename = $registro->historico->contrato->id.'-'.Str::random(16).'.'.$image->getClientOriginalExtension();

            $resize  =  ImageManager::gd()->read($image)->resize($registro->tipo->largura_imagem,$registro->tipo->altura_imagem);
            $resize->save(public_path('/layout/imagens/registros/').$filename);

            $this->nome         = $filename;
            $this->registro()->associate($registro);
            $this->descricao=$descricao;
            $this->save();


    }
}
