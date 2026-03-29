<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Historico;
use App\Models\Indicacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndicacaoController extends Controller
{
    private $dados;


    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function novo(Contrato $contrato,Historico $historico)
    {

        if (auth()->user()->cannot('contrato-indicacao-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Novo Indicacao',
            'titulo'            =>  'Nova Indicacao',
            'titulo_card'       =>  'Dados da Indicacao',
            'contrato'          =>  $contrato,
            'historico_selecionado'         =>  $historico,
        ];
        return view('admin.contratos.form.indicacao',$this->dados);
    }

    public function cadastrar(Contrato $contrato,Historico $historico)
    {
        if (auth()->user()->cannot('contrato-indicacao-criar')){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'indicacaos'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();
            $regras         =   [
                'data'      => 'required|date_format:d/m/Y',
                'descricao' =>  'required',
                'fornecedor'=>'required',
                'valor'     =>  'required',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $indicacao = new Indicacao();

            $indicacao->gravar(
                $r->input('fornecedor'),
                $r->input('historico'),
                $r->input('descricao'),
                $r->input('valor'),
                $r->input('data'),

            );

            return redirect()->route('contrato.indicacao.editar',['contrato'=>$contrato,'historico'=>$historico,'indicacao'=>$indicacao])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'indicacaos'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Contrato $contrato,Historico $historico, Indicacao $indicacao)
    {

        if (auth()->user()->cannot('contrato-indicacao-editar')){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'indicacaos'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Editar Indicacao',
            'titulo'            =>  'Editar Indicacao',
            'titulo_card'       =>  'Dados da Indicacao',
            'contrato'          =>  $contrato,
            'historico_selecionado'         =>  $historico,
            'indicacao'          =>  $indicacao
        ];
        return view('admin.contratos.form.indicacao',$this->dados);
    }

    public function atualizar(Contrato $contrato,Historico $historico, Indicacao $indicacao)
    {

        try{

            $r              =   \request();
            $regras         =   [
                'data'      => 'required|date_format:d/m/Y',
                'descricao' =>  'required',
                'fornecedor'=>'required',
                'valor'     =>  'required',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $indicacao->gravar(
                $r->input('fornecedor'),
                $r->input('historico'),
                $r->input('descricao'),
                $r->input('valor'),
                $r->input('data'),

            );


            return redirect()->route('contrato.indicacao.editar',['contrato'=>$contrato,'historico'=>$historico,'indicacao'=>$indicacao])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Usuário cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'indicacaos'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Contrato $contrato,Historico $historico, Indicacao $indicacao)
    {
        try{

            $indicacao->excluir();

            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'indicacoes'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Indicacao excluido com sucesso!.']);

        }catch (\Exception $exception){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$exception->getMessage()]);
        }
    }
}
