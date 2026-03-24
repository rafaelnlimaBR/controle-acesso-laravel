<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class Banner extends Model
{
    protected $table = 'banners';
    public $timestamps = true;

    public function scopePesquisarPorTitulo($query,$titulo)
    {
        return $query->where('titulo','like','%'.$titulo.'%');
    }

    public function scopePesquisarPorStatus($query,$status)
    {
        return $query->where('ativo','=',$status);
    }

    public function autor()
    {
        return $this->belongsTo('App\Models\User','autor_id');
    }

    public function gravar($titulo, $descricao, $ativo ,$link = null,UploadedFile $imagem =null,User $autor=null)
    {
        $this->titulo   = $titulo;
        $this->descricao    = $descricao;
        $this->ativo    = $ativo;
        $this->link     =   $link;
        if ($autor != null){
            $this->autor()->associate($autor);
        }

        if($imagem != null){
            if (!file_exists(public_path('/images/banners/'))) {
                mkdir(public_path('/images/banners/'), 0777, true);
            }
            if ($this->imagem != null){
                if (file_exists(    public_path('/images/banners/').$this->imagem)) {
                    unlink(public_path('/images/banners/').$this->imagem);
                }
            }
            $filename = "";
            $filename = Str::random(16) . '.' . $imagem->getClientOriginalExtension();

            $resize = ImageManager::gd()->read($imagem)->resize(1176
                , 580);
//            $resize  =  Image::read($imagem)->resize(350,200);
            $resize->save(public_path('/images/banners/') . $filename);


            $this->imagem = $filename;
        }

        $this->save();
    }

    public function excluir()
    {
        if (file_exists(    public_path('/images/banners/').$this->imagem)) {
            // Tenta excluir o arquivo
            if (unlink(public_path('/images/banners/').$this->imagem)) {
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
