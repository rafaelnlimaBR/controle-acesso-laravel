<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreaClienteController extends Controller
{
    protected $dados;

    public function __construct()
    {
        $this->dados = [

        ];
    }

    public function meuscontratos()
    {
        $this->dados    += [
            'titulo_pagina'    =>  'Tecvel - Meus Contratos',
            'titulo'            =>  'Meus Contratos',
            'titulo_tabela'     =>  'Meus Contratos',
            'contratos'         =>  auth()->user()->contratos()->PesquisarPorVeiculo(\request()->input('placa'))->get()
        ];

        return view('admin.areaCliente.meuscontratos',$this->dados);
    }
}
