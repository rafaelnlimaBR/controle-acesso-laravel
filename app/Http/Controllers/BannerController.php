<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    protected $dados;
    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function index()
    {

        if (auth()->user()->cannot('banner-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Banners',
            'titulo'            =>  'Banners',
            'titulo_tabela'     =>  'Lista de Banners',
            'banners'          =>  Banner::PesquisarPorTitulo(\request()->get('nome'))
                ->orderBy('id','desc')
                ->paginate(10)
                ->withQueryString()


        ];


        return view('admin.banners.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('banner-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Nova Banner',
            'titulo'            =>  'Nova Banner',
            'titulo_card'       =>  'Dados da Banner'
        ];

        return view('admin.banners.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('banner-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'titulo_banner'=>'required|min:2',
                'descricao'=>'required|min:3',
                'imagem'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $banner        =   new Banner();
            $banner->gravar(
                $r->input('titulo_banner'),
                $r->input('descricao'),
                $r->input('ativo'),
                $r->input('link'),
                $r->file('imagem'),
                auth()->user(),
            );

            return redirect()->route('banner.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Banner cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Banner $banner)
    {

        if (auth()->user()->cannot('banner-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Banner',
                'titulo'            =>  'Editar Banner',
                'titulo_card'       =>  'Dados da Banner',
                'banner'           =>  $banner,
            ];

            return view('admin.banners.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Banner $banner)
    {
        if (auth()->user()->cannot('banner-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'titulo_banner'=>'required|min:2',
                'descricao'=>'required|min:3',

            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $banner->gravar(
                $r->input('titulo_banner'),
                $r->input('descricao'),
                $r->input('ativo'),
                $r->input('link'),
                $r->file('imagem')
            );

            return redirect()->route('banner.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Banner cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Banner $banner)
    {
        if (auth()->user()->cannot('banner-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $banner->excluir();
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('banner.editar',['banner'=>$banner])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
