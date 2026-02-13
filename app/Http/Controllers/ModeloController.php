<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */


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
