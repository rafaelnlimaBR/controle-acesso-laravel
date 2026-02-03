<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dados;

    public function index()
    {


        $this->dados    = [
            'titulo_pagina'     =>  'Tecvel - Dashboard',
            'titulo'            =>  'Dashboard',
        ];
        return view('admin.dashboard.index', $this->dados);



    }
}
