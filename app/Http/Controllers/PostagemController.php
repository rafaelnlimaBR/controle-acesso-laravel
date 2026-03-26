<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\Postagem;
use App\Models\PostagemImagem;
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
                'titulo_link'=>'required|unique:App\Models\Postagem,titulo_link',
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
                auth()->user(),

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
                'comentarios'       =>  $postagem->comentarios()->orderBy('created_at','desc')->paginate(10)->withQueryString()
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
                'titulo_postagem'=>'required|min:3|max:120|unique:App\Models\Postagem,titulo,'.$postagem->id,
                'titulo_link'=>'required|unique:App\Models\Postagem,titulo_link,'.$postagem->id,
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
                auth()->user(),
                $r->input('imagem'),
            );
            $postagem->categorias()->sync($r->input('categoria'));

            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Postagem cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Postagem $postagem)
    {
        if (auth()->user()->cannot('postagem-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $postagem->excluir();
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Postagem excluida com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('postagem.editar',['postagem'=>$postagem])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function cadastrarImagem(Request $r,Postagem $postagem)
    {
        if (auth()->user()->cannot('postagem-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'nome_imagem'=>'required',
                'descricao'=>'required',
                'imagem_post'=>'required|file|mimes:jpeg,jpg,png'
            ];

            $validacao      =   Validator::make($r->all(),$regras);

            if($validacao->fails()){

                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $imagem = new PostagemImagem();


             $imagem->gravar(
                $r->input('nome_imagem'),
                $r->input('descricao'),
                $r->input('ativo'),
                $r->file('imagem_post'),

            );
            $imagem->postagens()->attach($postagem);

            return redirect()->route('postagem.editar',['postagem'=>$postagem,'pagina'=>'imagens'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Postagem cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editarImagem(Postagem $postagem, PostagemImagem $imagem)
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
                'imagem'            =>  $imagem,
            ];

            return view('admin.postagens.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('postagen.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluirImagem(Postagem $postagem, PostagemImagem $imagem)
    {
        try{

            if ($imagem->excluir() == false){
                return redirect()->route('postagem.editar',['postagem'=>$postagem,'pagina'=>'imagens'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Não foi possível excluir o arquivo!."]);
            }


            return redirect()->route('postagem.editar',['postagem'=>$postagem,'pagina'=>'imagens'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Imagem cadastrada com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }


    }

    public function cadastrarComentario(Postagem $postagem)
    {
        try{

            $r              =   \request();

            $regras         =   [
                'conteudo'=>'required'
            ];

            $validacao      =   Validator::make($r->all(),$regras);

            if($validacao->fails()){

                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $comentario     =   new Comentario();

            $comentario->salvar($r->input('conteudo'),auth()->user(),1);
            $comentario->postagens()->attach($postagem);

            return redirect()->route('postagem.editar',['postagem'=>$postagem,'pagina'=>'comentarios'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Comentario cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function cadastrarResposta(Postagem $postagem, Comentario $comentario)
    {
        try{

            $r              =   \request();

            $regras         =   [
                "resposta-".$comentario->id=>'required'
            ];

            $validacao      =   Validator::make($r->all(),$regras);

            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $resposta   =   new Comentario();
            $resposta->salvar($r->input('resposta-'.$comentario->id),auth()->user(),1);
            $comentario->respostas()->attach($resposta);

            return redirect()->route('postagem.editar',['postagem'=>$postagem,'pagina'=>'comentarios'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Comentario cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('postagem.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editarComentario( Postagem $postagem,Comentario $comentario)
    {


        return $comentario;

    }
}
