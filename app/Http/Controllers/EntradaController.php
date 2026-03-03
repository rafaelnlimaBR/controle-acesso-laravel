<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use App\Models\TaxaEntrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntradaController extends Controller
{


    public function gravar(Request $r)
    {
        try{
            $r              =   \request();

            $regras         =   [
                'valor_original'=>'required|numeric',
                'data'=>'required|date_format:d/m/Y',
                'descricao'=>'required',
//                'tecnico'=>'required',
            ];

            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $entrada = new Entrada();

            $taxa               =   TaxaEntrada::find($r->get('taxa_id'));
            $valor_original     =   $r->get('valor_original');
            $valor_liquido      =   0;
            $valor_bruto        =   0;

            if($r->has('rapassar_taxa')){

            }else{

            }





        }catch (\Exception $e){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
