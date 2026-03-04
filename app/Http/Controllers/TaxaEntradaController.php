<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TaxaEntrada;
use Illuminate\Http\Request;

class TaxaEntradaController extends Controller
{
    public function renderizarPagina(Request $r)
    {
        try{

            $taxa       =   TaxaEntrada::find($r->get('taxa_id'));
            if ($taxa->tipo->pix){
                $qrcode     =  $taxa->gerarQRCode($r->get('valor'));
                $html       =   view('admin.entradas.includes.qrcode')->with('qrcode',$qrcode)->render();

                return response()->json(['pagina'=>$html]);
            }




        }catch (\Exception $e){
            return response()->json(["error"=>$e->getMessage()]);
        }

    }

    public function pegarValorTaxa(Request $r)
    {
        try{
            $taxa   =   TaxaEntrada::find($r->get('taxa_id'));

            return $taxa;
        }catch (\Exception $e){
            return response()->json(["error"=>$e->getMessage()]);
        }
    }

}
