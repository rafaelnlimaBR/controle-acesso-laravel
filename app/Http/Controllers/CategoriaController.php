<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoriaPostagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    private $dados;


    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function index()
    {

        if (auth()->user()->cannot('categoria-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Categorias',
            'titulo'            =>  'Categorias',
            'titulo_tabela'     =>  'Lista de Categorias',
            'categorias'          =>  CategoriaPostagem::PesquisarPorNome(\request()->input('nome'))
                ->paginate(15)
                ->withQueryString()
        ];


        return view('admin.categorias.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('categoria-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Novo Categoria',
            'titulo'            =>  'Nova categoria',
            'titulo_card'       =>  'Dados do categoria'
        ];

        return view('admin.categorias.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('categoria-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'nome'=>'required|min:3|max:250',
                'link'=>'required|min:3|max:250|unique:App\Models\CategoriaPostagem,nome_link',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $categoria        =   new CategoriaPostagem();
            $categoria->gravar(\request()->input('nome'),$r->input('link'), $r->input('ativo'));

            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Categoria cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(CategoriaPostagem $categoria)
    {

        if (auth()->user()->cannot('categoria-editar') ){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Categoria',
                'titulo'            =>  'Editar Categoria',
                'titulo_card'       =>  'Dados da Categoria',
                'categoria'           =>  $categoria,
            ];

            return view('admin.categorias.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(CategoriaPostagem $categoria)
    {
        if (auth()->user()->cannot('categoria-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'nome'=>'required|min:3|max:250',
                'link'=>'required|min:3|max:250|unique:App\Models\CategoriaPostagem,nome_link,'.$categoria->id
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $categoria->gravar(\request()->input('nome'),$r->input('link'), $r->input('ativo'));

            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Categoria cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(CategoriaPostagem $categoria)
    {
        if (auth()->user()->cannot('categoria-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $categoria->delete();
            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('categoria.editar',['categoria'=>$categoria])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
