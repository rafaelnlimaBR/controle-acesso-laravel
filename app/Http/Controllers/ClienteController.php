<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        if (auth()->user()->cannot('clientes-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $this->dados    += [
            'titulo_pagina'     =>  'Tecvel - Clientes',
            'titulo'            =>  'Usuários',
            'titulo_tabela'     =>  'Lista de Clientes',
            'clientes'          =>  User::PesquisarPorClientes()->Visiveis()->PesquisarPorNome(\request()->get('nome'))
                ->PesquisarPorTelefone(\request()
                    ->get('numero'))
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString()
        ];


        return view('admin.Clientes.index',$this->dados);
    }
}
