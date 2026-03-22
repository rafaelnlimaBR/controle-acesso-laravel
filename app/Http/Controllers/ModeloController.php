<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    protected $dados;
    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function index()
    {

        if (auth()->user()->cannot('modelo-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Modelos',
            'titulo'            =>  'Modelos',
            'titulo_tabela'     =>  'Lista de Modelos',
            'modelos'          =>  Modelo::PesquisarPorNome(\request()->input('nome'))
                ->pesquisarPorMontadora(\request()->input('montadora'))
                ->orderBy('id','desc')
                ->paginate(10)
                ->withQueryString()


        ];


        return view('admin.modelos.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('modelo-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Nova Modelo',
            'titulo'            =>  'Nova Modelo',
            'titulo_card'       =>  'Dados da Modelo'
        ];

        return view('admin.modelos.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('modelo-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   ['nome'=>'required|min:2|max:100|unique:App\Models\Modelo,nome'];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $modelo        =   new Modelo();
            $modelo->gravar(
                $r->input('nome'),
                $r->input('montadora')
            );

            return redirect()->route('modelo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Modelo cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('modelo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Modelo $modelo)
    {

        if (auth()->user()->cannot('modelo-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Modelo',
                'titulo'            =>  'Editar Modelo',
                'titulo_card'       =>  'Dados da Modelo',
                'modelo'           =>  $modelo,
            ];

            return view('admin.modelos.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('modelo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Modelo $modelo)
    {
        if (auth()->user()->cannot('modelo-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   ['nome'=>'required|min:2|max:100|unique:App\Models\Modelo,nome,'.$modelo->id];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $modelo->gravar(
                $r->input('nome'),
                $r->input('montadora')
            );

            return redirect()->route('modelo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Modelo cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('modelo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Modelo $modelo)
    {
        if (auth()->user()->cannot('modelo-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $modelo->excluir();
            return redirect()->route('modelo.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('modelo.editar',['modelo'=>$modelo])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function pesquisarModeloAjax(Request $r)
    {
        try{
            $modelos = Modelo::PesquisarPorNome($r->get('q'))->limit(20)->get();


            $retorno    =   [];

            foreach ($modelos as $key => $value) {

                $retorno[$key]['id'] = $value->id;
                $retorno[$key]['nome'] = $value->nome;
                $retorno[$key]['text'] = $value->nome.' - '.$value->montadora->nome;


                $retorno[$key]['montadora'] = $value->montadora->nome;

            }
            return response()->json($retorno);
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }
}
