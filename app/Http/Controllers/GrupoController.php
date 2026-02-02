<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    private $dados;

    public function __construct()
    {
        $this->dados = [

        ];
    }

    public function index()
    {
        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Grupos',
            'titulo'            =>  'Grupos',
            'titulo_tabela'     =>  'Lista de Grupos',
            'grupos'          =>  Grupo::PesquisarPorNome(\request()->get('nome'))
                ->paginate(15)
                ->withQueryString()
        ];


        return view('admin.grupos.index',$this->dados);
    }

    public function novo()
    {
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Novo Grupo',
            'titulo'            =>  'Novo Grupo',
            'titulo_card'       =>  'Dados do Grupo'
        ];

        return view('admin.grupos.formulario',$this->dados);
    }

    public function cadastrar()
    {
        try{

            $r              =   \request();

            $validacao      =   Grupo::validacao($r->all());
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $grupo        =   new Grupo();
            $grupo->gravar(request());

            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('grupo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Grupo $grupo)
    {
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Grupo',
                'titulo'            =>  'Editar Grupo',
                'titulo_card'       =>  'Dados do Grupo',
                'grupo'           =>  $grupo,
            ];

            return view('admin.grupos.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('grupo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Grupo $grupo)
    {
        try{

            $r              =   \request();

            $validacao      =   Grupo::validacao($r->all(),$grupo->id);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $grupo->gravar(request());

            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('grupo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Grupo $grupo)
    {
        try {

            $grupo->delete();
            return redirect()->route('grupo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function adicionarContato(Grupo $grupo)
    {
        try{



            $validacao =   Contato::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->back()->withErrors($validacao)->withInput()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher com dados válidos!."]);
            }

            $contato    =   new Contato();
            $contato    = $contato->gravar(\request()->get('numero'));

            $grupo->contatos()->save($contato,['observacao'=>request()->input('observacao'),'whatsapp'=>\request()->has('whatsapp')?1:0]);

            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contato cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function removerContato(Grupo $grupo)
    {
        try{

            $grupo->contatos()->detach(request()->get('contato'));
            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contato removido com sucesso!."]);

        }catch (\Exception $e){
            return redirect()->route('grupo.editar',['grupo'=>$grupo])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
