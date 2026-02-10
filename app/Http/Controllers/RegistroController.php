<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Historico;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    private $dados;


    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function novo(Contrato $contrato,Historico $historico)
    {

        if (auth()->user()->cannot('contrato-registro-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Novo Registro',
            'titulo'            =>  'Novo Registro',
            'titulo_card'       =>  'Dados do Registro',
            'contrato'          =>  $contrato,
            'historico_selecionado'         =>  $historico,
        ];
        return view('admin.contratos.form.registro',$this->dados);
    }

    public function cadastrar(Contrato $contrato,Historico $historico)
    {
        if (auth()->user()->cannot('contrato-registro-criar')){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'registros'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();
            $regras         =   [
                'data'      => 'required|date_format:d/m/Y'
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $registro = new Registro();

            $registro->gravar(request());

            return redirect()->route('contrato.registro.editar',['contrato'=>$contrato,'historico'=>$historico,'registro'=>$registro])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'registros'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Contrato $contrato,Historico $historico, Registro $registro)
    {

        if (auth()->user()->cannot('contrato-registro-editar')){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'registros'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Editar Registro',
            'titulo'            =>  'Editar Registro',
            'titulo_card'       =>  'Dados do Registro',
            'contrato'          =>  $contrato,
            'historico_selecionado'         =>  $historico,
            'registro'          =>  $registro
        ];
        return view('admin.contratos.form.registro',$this->dados);
    }

    public function atualizar(Contrato $contrato,Historico $historico, Registro $registro)
    {

        try{

            $r              =   \request();
            $regras         =   [
                'data'      => 'required|date_format:d/m/Y',

            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }


            $registro->gravar(request());

            return redirect()->route('contrato.registro.editar',['contrato'=>$contrato,'historico'=>$historico,'registro'=>$registro])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'registros'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
