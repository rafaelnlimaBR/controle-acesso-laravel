<?php

namespace App\Http\Controllers;

use App\Models\Montadora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MontadoraController extends Controller
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

        if (auth()->user()->cannot('montadora-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Montadoras',
            'titulo'            =>  'Montadoras',
            'titulo_tabela'     =>  'Lista de Montadoras',
            'montadoras'          =>  Montadora::PesquisarPorNome(\request()->get('nome'))
                ->orderBy('id','desc')
                ->paginate(10)
                ->withQueryString()


        ];


        return view('admin.montadoras.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('montadora-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Nova Montadora',
            'titulo'            =>  'Nova Montadora',
            'titulo_card'       =>  'Dados da Montadora'
        ];

        return view('admin.montadoras.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('montadora-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   ['nome'=>'required|min:2|max:100|unique:App\Models\Montadora,nome'];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $montadora        =   new Montadora();
            $montadora->gravar(
                $r->input('nome'),
            );

            return redirect()->route('montadora.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Montadora cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('montadora.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Montadora $montadora)
    {

        if (auth()->user()->cannot('montadora-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Montadora',
                'titulo'            =>  'Editar Montadora',
                'titulo_card'       =>  'Dados da Montadora',
                'montadora'           =>  $montadora,
            ];

            return view('admin.montadoras.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('montadora.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Montadora $montadora)
    {
        if (auth()->user()->cannot('montadora-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   ['nome'=>'required|min:2|max:100|unique:App\Models\Montadora,nome,'.$montadora->id];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $montadora->gravar(
                $r->input('nome'),
            );

            return redirect()->route('montadora.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Montadora cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('montadora.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Montadora $montadora)
    {
        if (auth()->user()->cannot('montadora-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $montadora->excluir();
            return redirect()->route('montadora.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('montadora.editar',['montadora'=>$montadora])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function modelos(Request $r, $id)
    {
        try{
            $montadora      =   Montadora::find($id);

            $modelos        =   $montadora->modelos;

            return response()->json(['modelos'=>$modelos]);


        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
}
