<?php

namespace App\Http\Controllers;

use App\Models\Montadora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MontadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function modelos(Request $r, $id)
    {
        try{
            $montadora      =   Montadora::find($id);

            $modelos        =   $montadora->modelos;

            return response()->json(['modelos'=>$modelos]);


        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
}
