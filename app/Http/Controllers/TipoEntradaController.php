<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoEntrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoEntradaController extends Controller
{
    private $dados;


    public function __construct()
    {
        $this->dados = [

        ];

    }

    public function index()
    {

        if (auth()->user()->cannot('tipoentrada-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Tipo de Pagamentos',
            'titulo'            =>  'Tipo de Pagamentos',
            'titulo_tabela'     =>  'Lista de Tipo de Pagamentos',
            'tipos'          =>  TipoEntrada::PesquisarPorNome(\request()->input('nome'))
                ->paginate(15)
                ->withQueryString()
        ];


        return view('admin.tipoentradas.index',$this->dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('tipoentrada-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Tipo de Pagamento',
            'titulo'            =>  'Novo Tipo de Pagamento',
            'titulo_card'       =>  'Dados do Tipo'
        ];

        return view('admin.tipoentradas.formulario',$this->dados);
    }

    public function cadastrar()
    {
        if (auth()->user()->cannot('tipoentrada-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   ['nome'=>'required|min:3|max:100|unique:App\Models\TipoEntrada,nome'];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }
            $tipo       =   new TipoEntrada();
            $tipo->gravar(
                $r->input('nome'),
                $r->input('pix'),
                $r->input('ativo'),
            );

            return redirect()->route('tipoPagamento.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Grupo cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('tipoPagamento.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(TipoEntrada $tipo)
    {

        if (auth()->user()->cannot('tipoentrada-editar') ){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{
            $this->dados    += [
                'titulo_pagina'    =>  'Tecvel - Editar Tipo de Pagamento',
                'titulo'            =>  'Editar Tipo de Pagamento',
                'titulo_card'       =>  'Dados do Tipo de Pagamento',
                'tipo'           =>  $tipo,
            ];

            return view('admin.tipoentradas.formulario',$this->dados);

        }catch (\Exception $e){
            return redirect()->route('grupo.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(TipoEntrada $tipo)
    {
        if (auth()->user()->cannot('tipoentrada-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   ['nome'=>'required|min:3|max:100|unique:App\Models\TipoEntrada,nome,'.$tipo->id];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $tipo->gravar(
                $r->input('nome'),
                $r->input('pix'),
                $r->input('ativo'),
            );

            return redirect()->route('tipoPagamento.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Grupo cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('tipoPagamento.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(TipoEntrada $tipo)
    {
        if (auth()->user()->cannot('tipoentrada-deletar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try {

            $tipo->excluir();
            return redirect()->route('tipoPagamento.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);
        }catch (\Exception $e){
            return redirect()->route('tipoPagamento.editar',['tipo'=>$tipo])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

}
