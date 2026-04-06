<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicoController extends Controller
{
    protected $dados;
    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function index()
    {

        if (auth()->user()->cannot('servico-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Servicos',
            'titulo'            =>  'Servicos',
            'titulo_tabela'     =>  'Lista de Servicos',
            'servicos'          =>  Servico::PesquisarPorNome(\request()->get('nome'))
                ->orderBy('id','desc')
                ->paginate(10)
                ->withQueryString()


        ];


        return view('admin.servicos.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('servico-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Nova Servico',
            'titulo'            =>  'Nova Servico',
            'titulo_card'       =>  'Dados da Servico'
        ];

        return view('admin.servicos.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('servico-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'nome'=>'required|min:2|max:100|unique:App\Models\Servico,nome',
                'valor'=>'required|decimal:0,2'
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $servico        =   new Servico();
            $servico->gravar(
                $r->input('nome'),
                $r->input('valor')
            );

            return redirect()->route('servico.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Servico cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Servico $servico)
    {

        if (auth()->user()->cannot('servico-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Servico',
                'titulo'            =>  'Editar Servico',
                'titulo_card'       =>  'Dados da Servico',
                'servico'           =>  $servico,
            ];

            return view('admin.servicos.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Servico $servico)
    {
        if (auth()->user()->cannot('servico-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   ['nome'=>'required|min:2|max:100|unique:App\Models\Servico,nome,'.$servico->id];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $servico->gravar(
                $r->input('nome'),
                $r->input('valor')
            );

            return redirect()->route('servico.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Servico cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Servico $servico)
    {
        if (auth()->user()->cannot('servico-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $servico->excluir();
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('servico.editar',['servico'=>$servico])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function pesquisarServicoAjax(Request $r)
    {
        try{
            $servicos    =   Servico::pesquisarPorNome($r->get('q'))->get();


            $retorno    =   [];

            foreach ($servicos as $key => $value) {

                $retorno[$key]['id'] = $value->id;
                $retorno[$key]['text'] = $value->nome;
                $retorno[$key]['nome'] = $value->nome;
                $retorno[$key]['valor'] = $value->valor;



            }
            return response()->json($retorno);
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }

    }
}
