<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Configuracao;
use App\Models\Contrato;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContratoController extends Controller
{
    protected $conf;

    public function __construct()
    {
        $this->conf = Configuracao::getConfig();
    }

    public function index()
    {

        if (auth()->user()->cannot('grupo-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $dados    = [
            'titulo_pagina'     =>  'Tecvel - Contratos',
            'titulo'            =>  'Contratos',
            'titulo_tabela'     =>  'Lista de Contratos',
            'contrato'          => Contrato::find(2)

        ];


        return view('admin.contratos.index',$dados)->with('contratos',Contrato::all());
    }

    public function novo()
    {

        if (auth()->user()->cannot('contrato-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $dados    =[
            'titulo_pagina'    =>  'Tecvel - Novo Contrato',
            'titulo'            =>  'Novo Contrato',
            'titulo_card'       =>  'Dados do Contrato',
            'tecnicos'          =>  User::PesquisarPorGrupo($this->conf->grupo_tecnico_id)->get(),
            'grupo_cliente_id'  => $this->conf->grupo_cliente_id,
        ];

        return view('admin.contratos.formulario',$dados);
    }

    public function cadastrar()
    {

        if (auth()->user()->cannot('contrato-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'cliente'=>'required',
                'data_inicio'=>'required|date_format:d/m/Y',
                'tecnico'=>'required',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $contrato       =   new Contrato();
            $status         =   Status::find($this->conf->orcamento_id);

            $contrato->gravar(request());
            $contrato->status()->attach($status,['descricao'=>'Orçamento criado','data'=>Carbon::parse($r->get('data_inicio'))->format('Y-m-d')]);

            return redirect()->route('contrato.editar',['contrato'=>$contrato])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contratro cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Contrato $contrato)
    {

        if (auth()->user()->cannot('contrato-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $dados  = [
                'titulo_pagina'    =>  'Tecvel - Editar Contrato',
                'titulo'            =>  'Editar Contrato',
                'titulo_card'       =>  'Dados do Contrato',
                'contrato'           =>  $contrato,
                'tecnicos'          =>  User::PesquisarPorGrupo($this->conf->grupo_tecnico_id)->get(),
            ];

            return view('admin.contratos.formulario',$dados);

        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Contrato $contrato)
    {
        if (auth()->user()->cannot('contrato-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'cliente'=>'required',
                'data_inicio'=>'required|date_format:d/m/Y',
                'tecnico'=>'required',
            ];

            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $contrato->gravar(request());

            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contrato cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

}
