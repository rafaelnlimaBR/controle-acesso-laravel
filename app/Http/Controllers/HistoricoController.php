<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoricoController extends Controller
{


    public function atualziar(Contrato $contrato,Historico $historico)
    {
        try{
            $r              =   \request();
            $regras         =   [
                'data'=>'required|date_format:d/m/Y',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'historicos'])->withErrors($validacao)->withInput()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatorios!."]);
            }
            $historico->gravar(request());

            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'historicos'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Historico atualizado com sucesso!."]);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'historicos'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
