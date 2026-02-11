<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Historico;
use App\Models\Registro;
use App\Models\RegistroImagem;
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
                'data'      => 'required|date_format:d/m/Y',
                'descricao' =>  'required'
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

    public function excluir(Contrato $contrato,Historico $historico, Registro $registro)
    {
        try{

            $registro->excluir();

            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'registros'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!.']);

        }catch (\Exception $exception){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$exception->getMessage()]);
        }
    }

    public function adicionarImagens(Contrato $contrato,Historico $historico, Registro $registro)
    {
        try{
            $r              =   \request();
            $regras     =   [
                'imagens'     => 'required|array|max:15', // The field itself is a required array, max 10 files
                'imagens.*'   => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
//
            $validacao   =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao);
            }
            foreach($r->file('imagens') as $i=> $image){

                $imagem = new RegistroImagem();
                $imagem->gravar($registro,$image,$r->get('descricao'));
            }

            return redirect()->back()->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Imagens adicionais cadastradas com sucesso!.']);

        }catch (\Exception $e){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizarImagem(Contrato $contrato, Historico $historico, RegistroImagem $imagem)
    {
        try{

            $imagem->atualizar(request('descricao'));

            return redirect()->back()->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Imagem atualizada com sucesso!.']);


        }catch (\Exception $e){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluirImagem(Contrato $contrato, Historico $historico,Registro $registro, RegistroImagem $imagem)
    {
        try{

            $imagem->excluir();

            return redirect()->route('contrato.registro.editar',['contrato'=>$contrato,'historico'=>$historico,'registro'=>$registro])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Imagem excluida com sucesso!.']);

        }catch (\Exception $e){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }


}
