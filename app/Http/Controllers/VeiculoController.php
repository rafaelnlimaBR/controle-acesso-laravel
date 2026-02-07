<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Veiculo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VeiculoController extends Controller
{
    private $dados;


    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function index()
    {

        if (auth()->user()->cannot('veiculo-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Veiculos',
            'titulo'            =>  'Veiculos',
            'titulo_tabela'     =>  'Lista de Veiculos',
            'veiculos'          =>  Veiculo::
                pesquisarPorModelo(request()->has('modelo')?request()->get('modelo'):0)
                ->pesquisarPorPlaca(request()->get('placa'))
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString()
        ];


        return view('admin.veiculos.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('grupo-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Novo Veiculo',
            'titulo'            =>  'Novo Veiculo',
            'titulo_card'       =>  'Dados do Veiculo',

        ];

        return view('admin.veiculos.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('veiculo-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();
            $regras         =   [
                'placa'=>'required|min:3|max:100|unique:App\Models\Veiculo,placa',
                'modelo'=>'required',
                'ano'=>'required',];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $veiculo        =   new Veiculo();
            $veiculo->gravar(request());

            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Veiculo $veiculo)
    {

        if (auth()->user()->cannot('veiculo-editar') ){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Veículo',
                'titulo'            =>  'Editar Veículo',
                'titulo_card'       =>  'Dados do Veículo',
                'veiculo'           =>  $veiculo,
            ];

            return view('admin.veiculos.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Veiculo $veiculo)
    {
        if (auth()->user()->cannot('veiculo-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();
            $regras         =   [
                'placa'=>'required|min:3|max:100|unique:App\Models\Veiculo,placa,'.$veiculo->id,
                'modelo'=>'required',
                'ano'=>'required',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $veiculo->gravar(request());

            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Veiculo $veiculo)
    {
        if (auth()->user()->cannot('veiculo-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $veiculo->delete();
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('veiculo.editar',['veiculo'=>$veiculo])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }


}
