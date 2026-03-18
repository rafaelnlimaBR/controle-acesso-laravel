<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Postagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostagemController extends Controller
{
    private $dados;


    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function index()
    {

        if (auth()->user()->cannot('postagem-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Postagens',
            'titulo'            =>  'Postagens',
            'titulo_tabela'     =>  'Lista de Postagens',
            'postagens'          =>  Postagem::PesquisarPorTitulo(\request()->input('titulo'))
                ->paginate(15)
                ->withQueryString()
        ];


        return view('admin.postagens.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('postagem-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Novo Postagem',
            'titulo'            =>  'Nova Postagem',
            'titulo_card'       =>  'Dados da Postagem'
        ];

        return view('admin.postagens.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('postagem-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'titulo_postagem'=>'required|min:3|max:120|unique:App\Models\Postagem,titulo',
                'titulo_link'=>'required',
                'conteudo'=>'required',
                'meta_descricao'=>'required',
                'categoria'=>'required|array|min:1'
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $postagem        =   new Postagem();
//            ($titulo, $link, $ativo, $conteudo, $meta,User $autor)
            $postagem->gravar(
                $r->input('titulo_postagem'),
                $r->input('titulo_link'),
                $r->input('ativo'),
                $r->input('conteudo'),
                $r->input('meta_descricao'),
                auth()->user()
            );

            $postagem->categorias()->sync($r->input('categoria'));

            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Grupo cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Postagem $postagem)
    {

        if (auth()->user()->cannot('postagem-editar') ){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Postagem',
                'titulo'            =>  'Editar Postagem',
                'titulo_card'       =>  'Dados da Postagem',
                'postagem'           =>  $postagem,
            ];

            return view('admin.postagens.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('postagen.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Postagem $postagem)
    {
        if (auth()->user()->cannot('postagem-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'titulo_postagem'=>'required|min:3|max:120|unique:App\Models\Postagem,titulo',$postagem->id,
                'titulo_link'=>'required',
                'conteudo'=>'required',
                'meta_descricao'=>'required',
                'categoria'=>'required|array|min:1'
            ];

            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $postagem->gravar(
                $r->input('titulo_postagem'),
                $r->input('titulo_link'),
                $r->input('ativo'),
                $r->input('conteudo'),
                $r->input('meta_descricao'),
                auth()->user()
            );
            $postagem->categorias()->sync($r->input('categoria'));

            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Postagem cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Grupo $grupo)
    {
        if (auth()->user()->cannot('grupo-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $grupo->delete();
            return redirect()->route('grupo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
