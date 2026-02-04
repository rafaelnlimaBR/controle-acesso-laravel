<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\User;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    private $dados;

    public function __construct()
    {
        $this->dados = [

        ];
    }

    public function index()
    {
        if (auth()->user()->cannot('usuario-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Usuarios',
            'titulo'            =>  'Usuários',
            'titulo_tabela'     =>  'Lista de Usuários',
            'usuarios'          =>  User::PesquisarPorNome(\request()->get('nome'))
                ->PesquisarPorTelefone(\request()
                ->get('numero'))
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString()
        ];


        return view('admin.usuarios.index',$this->dados);
    }

    public function novo()
    {
        if (auth()->user()->cannot('usuario-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Novo Usuário',
            'titulo'            =>  'Novo Usuário',
            'titulo_card'       =>  'Dados do Usuário'
        ];

        return view('admin.usuarios.formulario',$this->dados);
    }

    public function cadastrar()
    {

        try{

            $r              =   \request();

            $validacao      =   User::validacao($r->all());
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $usuario        =   new User();
            $usuario->gravar(request());
            $usuario->adicionarContato($r->get('contato'),$r->has('whatsapp')?true:false,$r->get('observacao'));

            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('usuario.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(User $usuario)
    {
        if (auth()->user()->cannot('usuario-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Usuário',
                'titulo'            =>  'Editar Usuário',
                'titulo_card'       =>  'Dados do Usuário',
                'usuario'           =>  $usuario,
            ];

            return view('admin.usuarios.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('usuario.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(User $usuario)
    {
        try{

            $r              =   \request();

            $validacao      =   User::validacao($r->all(),$usuario->id);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $usuario->gravar(request());

            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('usuario.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(User $usuario)
    {
        if (auth()->user()->cannot('usuario-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $usuario->delete();
            return redirect()->route('usuario.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function adicionarContato(User $usuario)
    {
        try{



            $validacao =   Contato::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->back()->withErrors($validacao)->withInput()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher com dados válidos!."]);
            }

            $usuario->adicionarContato(\request()->get('numero'),\request()->has('whatsapp')?true:false,\request()->get('observacao'));

            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contato cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function removerContato(User $usuario)
    {
        try{

            $usuario->removerContato(\request()->get('contato'));

            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contato removido com sucesso!."]);

        }catch (\Exception $e){
            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

}
