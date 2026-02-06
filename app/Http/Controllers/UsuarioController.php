<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;


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
            'usuarios'          =>  User::Visiveis()->PesquisarPorNome(\request()->get('nome'))
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
            $regras =   [
                'nome'          =>  'required|min:3|max:100',
                'email'         =>  'required|email|unique:App\Models\User,email',
                'nome_completo' =>  'required|min:3|max:100',
                'grupos'        =>  'required|array|min:1',
                'senha'         =>  'required|min:3|max:8',
                'contato'       =>  'required',
                /*'imagem'        =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
            ];
            $validacao      =   Validator::make($r->all(),$regras);
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
            $regras =   [
                'nome'          =>  'required|min:3|max:100',
                'email'         =>  'required|email|unique:App\Models\User,email,'.$usuario->id,
                'nome_completo' =>  'required|min:3|max:100',
                'grupos'        =>  'required|array|min:1',
            ];
            $validacao      =   Validator::make($r->all(),$regras);

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

            $usuario->deletar();
            return redirect()->route('usuario.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function adicionarContato(User $usuario)
    {
        try{

            $regras =   [
                'contato'        =>  'required',
            ];
            $validacao      =   Validator::make(request()->all(),$regras);

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
            if($usuario->contatos()->count() == 1){
                return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Não foi possível excluir. O usuários tem que ter pelo menos um registro de contato!."]);
            }
            $usuario->removerContato(\request()->get('contato'));

            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contato removido com sucesso!."]);

        }catch (\Exception $e){
            return redirect()->route('usuario.editar',['usuario'=>$usuario])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function formularioNovaSenha()
    {
        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Usuarios',
            'titulo'            =>  'Usuários',
            'titulo_card'       =>  "Mudar sua senha"
        ];
        return view('admin.usuarios.formulario-nova-senha',$this->dados);
    }

    public function postNovaSenha()
    {
        try{

            $regras =   [
                'senha'         =>  'required|min:4|max:8',
            ];
            $validacao      =   Validator::make(request()->all(),$regras);

            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            auth()->user()->mudarSenha(\request()->get('senha'));
            return redirect()->route('usuario.mudar.senha')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Senha alterada com sucesso!."]);

        }catch (\Exception $e){
            return redirect()->route('usuario.mudar.senha')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }


    }

}
