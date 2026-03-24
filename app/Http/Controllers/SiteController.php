<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Configuracao;
use App\Models\Contrato;
use App\Models\Montadora;
use App\Models\Registro;
use App\Models\User;
use App\Models\Veiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    private $conf;
    public function __construct()
    {
        $this->conf = Configuracao::first();
    }

    public function index()
    {
        $dados  =[
            'banners'       =>  Banner::pesquisarPorStatus(1)->get(),
            'conf'          =>  $this->conf,
        ];
        return view('site.home', $dados);
    }

    public function fazerOrcamento()
    {
        $dados  = [
            'titulo'        =>  'Tecvel - Fazer Orçamento',
            'conf'              =>  $this->conf,
        ];

        return view('site.fazer-orcamento',$dados);
    }

    public function cadastrarOrcamento(Request $r)
    {
        try{

//            return $r->all();
            $regras         =   [
                'nome'=>'required',
                'email'=>'required|email',
                'contato'=>'required',
                'descricao'=>'required',
                'cadastrar_veiculo'=>'sometimes|accepted',
                'placa'=>'required_if:cadastrar_veiculo,on',
                'ano'=>'required_if:cadastrar_veiculo,on',
                'modelo'=>'required_if:cadastrar_veiculo,on',
                'montadora'=>'required_if:cadastrar_veiculo,on',
            ];


            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                $montadora          =   Montadora::find($r->input('montadora'));
                $modelos            =   $montadora->modelos;

                return redirect()->route('site.fazer.orcamento')->withInput()->withErrors($validacao)->with('modelos_retorno',$modelos)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);

            }
            $cliente        =   User::where('email',$r->input('email'))->first();


            if($cliente == null){
                $cliente    =   new User();
                $cliente->gravar(
                    $r->input('nome'),
                    $r->input('email'),
                    $r->input('senha'),
                    $this->conf->grupo_cliente_id,
                    '1',
                    $r->input('contato'),
                    1,
                );
            }
            $veiculo    =   null;
            if ($r->has('cadastrar_veiculo')){
                $veiculo        =   Veiculo::where('placa',$r->input('placa'))->first();
                if($veiculo == null){
                    $veiculo    =   new Veiculo();
                    $veiculo->gravar(
                        $r->input('placa'),
                        $r->input('cor'),
                        $r->input('ano'),
                        $r->input('modelo')
                    );
                }
            }

//            User $cliente,$data_inicio, $descricao_cliente, Veiculo $veiculo=null,$observacao=null,User $autor=null, User $tecnico=null  )
            $contrato       =   new Contrato();
            $contrato->gravar(
                $cliente,
                Carbon::now()->format('d/m/Y'),
                $r->input('descricao'),
                $veiculo
            );

            $contrato->status()->attach($this->conf->orcamento_online_id,['descricao'=>'Solicitação de orçamento criano online','data'=>Carbon::now(),'autor_id'=>null]);
            $registro       =   new Registro();

            $registro->gravar(
                Carbon::now()->format('d/m/Y'),
                $r->input('descricao'),
                $this->conf->descricao_cliente_id,
                $contrato->historicos->last(),
                null
            );


            return redirect()->back()->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('site.fazer.orcamento')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }
}
