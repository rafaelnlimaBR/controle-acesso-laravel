<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;


class PostagemImagem extends Model
{
    protected $table = 'imagens_posts';

    public $timestamps = true;

    public function postagens()
    {
        return $this->belongsToMany(Postagem::class, 'postagens_imagens', 'imagem_id', 'postagem_id');
    }

    public function gravar ($tiulo, $descricao, $ativo, UploadedFile $imagem)
    {


        $this->nome         = $tiulo;
        $this->descricao    = $descricao;
        $this->ativo        = $ativo;




            if (!file_exists(public_path('/images/postagens/'))) {
                mkdir(public_path('/images/postagens/'), 0777, true);
            }
            $filename = "";
            $filename = Str::random(16) . '.' . $imagem->getClientOriginalExtension();

            $resize = ImageManager::gd()->read($imagem)->resize(350, 200);
//            $resize  =  Image::read($imagem)->resize(350,200);
            $resize->save(public_path('/images/postagens/') . $filename);


            $this->imagem = $filename;


            $this->save();
    }

    public function excluir()
    {
        if (file_exists(    public_path('/images/postagens/').$this->imagem)) {
            // Tenta excluir o arquivo
            if (unlink(public_path('/images/postagens/').$this->imagem)) {
                $this->delete();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
