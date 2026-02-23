<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{


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
