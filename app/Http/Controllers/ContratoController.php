<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Configuracao;
use App\Models\Contrato;
use App\Models\Entrada;
use App\Models\Historico;
use App\Models\PecaAvulsa;
use App\Models\Status;
use App\Models\TaxaEntrada;
use App\Models\TipoEntrada;
use App\Models\User;
use App\Models\Veiculo;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Types\Relations\Car;

class ContratoController extends Controller
{
    protected $conf;

    public function __construct()
    {
        $this->conf = Configuracao::getConfig();
    }

    public function index()
    {

        if (auth()->user()->cannot('grupo-lista')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }

        $dados    = [
            'titulo_pagina'     =>  'Tecvel - Contratos',
            'titulo'            =>  'Contratos',
            'titulo_tabela'     =>  'Lista de Contratos',
            'contratos'          => Contrato::
                PesquisarPorVeiculo(\request()->has('placa')?\request()->input('placa'):"",)
                ->PesquisarPorCliente(request('cliente'))
                ->PesquisarPorData(request('data'))
                ->orderBy('data_inicio','desc')
                ->paginate(15)
                ->withQueryString(),

        ];


        return view('admin.contratos.index',$dados);
    }

    public function novo()
    {

        if (auth()->user()->cannot('contrato-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        $dados    =[
            'titulo_pagina'    =>  'Tecvel - Novo Contrato',
            'titulo'            =>  'Novo Contrato',
            'titulo_card'       =>  'Dados do Contrato',
            'tecnicos'          =>  User::PesquisarPorGrupo($this->conf->grupo_tecnico_id)->get(),
            'grupo_selecionado'    => $this->conf->grupo_cliente_id,
        ];

        return view('admin.contratos.formulario',$dados);
    }

    public function cadastrar()
    {

        if (auth()->user()->cannot('contrato-criar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'cliente'=>'required',
                'data_inicio'=>'required|date_format:d/m/Y',
                'tecnico'=>'required',
            ];
            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validacao)
                    ->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);

            }
            $contrato       =   new Contrato();
            $status         =   Status::find($this->conf->orcamento_id);

//            User $cliente,$data_inicio, $descricao_cliente, Veiculo $veiculo=null,$observacao=null,User $autor=null, User $tecnico=null  )
            $contrato->gravar(
                User::find($r->input('cliente')),
                $r->input('data_inicio'),
                $r->input('descricao'),
                $r->has('veiculo')?Veiculo::find($r->input('veiculo')):null,
                $r->input('observacao'),
                $r->input('solucao'),
                auth()->user(),
                User::find($r->input('tecnico'))
            );

            $contrato->status()->attach($status,['descricao'=>'Orçamento criado','autor_id'=>auth()->user()->id,'data'=>Carbon::createFromFormat('d/m/Y',$r->get('data_inicio'))->format('Y-m-d')]);

            $historico_atual    =   $contrato->historicos->last();

            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico_atual])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contratro cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.novo')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function editar(Contrato $contrato,Historico $historico)
    {

        if (auth()->user()->cannot('contrato-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        if(is_null($historico) or is_null($contrato)){
            return "null";
        }

        try{
            $dados  = [
                'titulo_pagina'    =>  'Tecvel - Editar Contrato',
                'titulo'            =>  'Editar Contrato - '.$historico->status->nome,
                'titulo_card'       =>  'Dados do Contrato',
                'contrato'           =>  $contrato,
                'historico_selecionado'   =>  $historico,
                'tecnicos'          =>  User::PesquisarPorGrupo($this->conf->grupo_tecnico_id)->get(),
                'proximos_status'   => $contrato->status->last()->proximos,
                'grupo_selecionado'    => $this->conf->grupo_cliente_id,
            ];

            return view('admin.contratos.formulario',$dados);

        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizar(Contrato $contrato,Historico $historico)
    {

        if (auth()->user()->cannot('contrato-editar')){
            return redirect()->route('dashboard.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{

            $r              =   \request();

            $regras         =   [
                'cliente'=>'required',
                'data_inicio'=>'required|date_format:d/m/Y',
                'tecnico'=>'required',
            ];

            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $contrato->gravar(
                User::find($r->input('cliente')),
                $r->input('data_inicio'),
                $r->input('descricao'),
                $r->has('veiculo')?Veiculo::find($r->input('veiculo')):null,
                $r->input('observacao'),
                $r->input('solucao'),
                auth()->user(),
                User::find($r->input('tecnico'))
            );

            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'dados'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Contrato cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function excluir(Contrato $contrato)
    {
        if (auth()->user()->cannot('contrato-deletar')){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Acesso negado!"]);
        }
        try{



            $contrato->excluir();
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Registro excluido com sucesso!']);

        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }

    }

    public function mudarStatus(Request $r ,Contrato $contrato)
    {
        try {
            $status_id  =   $r->input('status_id');

            switch ($status_id) {
                case $this->conf->andamento_id : //ANDAMENTO
                    $contrato->cobrarServicos(1);
                    $contrato->cobrarPecasAvulsas(1);
                    break;
                case $this->conf->concluido_id : //CONCLUIDO
                    $contrato->data_garantia    =   Carbon::now()->addDays(90);
                    $contrato->save();
                    break;

                case $this->conf->cancelado_id : //CANCELADO
                    $contrato->cobrarServicos(0);
                    $contrato->cobrarPecasAvulsas(0);
                    break;
                case $this->conf->retorno_id :   //RETORNO

                    break;
                case $this->conf->nao_autorizado_id :   //NAO AUTORIZADO
                    $contrato->cobrarServicos(0);
                    $contrato->cobrarPecasAvulsas(0);
                    break;
            }


            $status     =   Status::find($r->input('status_id'));
            $contrato->status()->attach($status,['descricao'=>request('descricao'),'autor_id'=>auth()->user()->id,'data'=>Carbon::now()]);

            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$contrato->historicos->last(),'pagina'=>'dados'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Status alterado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function adicionarServico(Request $r, Contrato $contrato,Historico $historico)
    {
        try {

            $historico->servicos()->attach($r->get('servico'),['valor_liquido'=>$r->get('valor'),'valor_bruto'=>$r->get('valor'),'desconto'=>0,'cobrar'=>$r->get('cobrar')]);

            $html       =   view('admin.contratos.includes.servico-tabela')->with('contrato',$contrato)->render();
            return response()->json(['tabela_servicos'=>$html]);

        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function adicionarPecaAvulsa(Request $r,Contrato $contrato, Historico $historico)
    {
        try {
            $regras         =   [
                'nome'=>'required',
                'valor'=>'required|numeric|decimal:0,2',
                'desconto'=>'required',
                'qnt'=>'required|gte:1',
            ];

            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                $html       =   view('admin.contratos.form.peca_avulsa')
                    ->withErrors($validacao)
                    ->with('marca',$r->get('marca'))
                    ->with('desconto',$r->get('desconto'))
                    ->with('valor',$r->get('valor'))
                    ->with('nome',$r->get('nome'))
                    ->with('qnt',$r->get('qnt'))
                    ->with('contrato',$contrato)
                    ->with('historico_selecionado',$historico)
                    ->render();
                return response()->json(['peca_html'=>$html,'error'=>'erro de validação']);

            }

            $peca                       =   new PecaAvulsa();
            $peca->nome                 =   $r->get('nome');
            $peca->valor_bruto          =   $r->get('valor');
            $peca->desconto             =   $r->get('desconto');
            $peca->valor_liquido        =   $peca->valor_bruto-($peca->valor_bruto * ($peca->desconto / 100));
            $peca->cobrar               =   $r->get('cobrar');
            $peca->marca                =   $r->get('marca');
            $peca->qnt                  =   $r->get('qnt');
            $peca->historico_id         =   $historico->id;
            $peca->save();

            $html       =   view('admin.contratos.includes.pecas-avulsas-tabela')
                ->with('contrato',$contrato)
                ->render();
            return response()->json(['tabela_pecas_avulsas'=>$html]);

        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function atualizarPecaAvulsa(Request $r)
    {
        try {

            $historico                  =   Historico::find($r->get('historico_id'));
            $peca                       =   PecaAvulsa::find($r->get('peca_id'));
            $peca->nome                 =   $r->get('nome');
            $peca->valor_bruto          =   $r->get('valor_bruto');
            $peca->desconto             =   $r->get('desconto');
            $peca->valor_liquido        =   $r->get('valor_liquido');
            $peca->cobrar               =   $r->get('cobrar');
            $peca->marca                =   $r->get('marca');
            $peca->qnt                  =   $r->get('qnt');
            $peca->save();

            $html       =   view('admin.contratos.includes.pecas-avulsas-tabela')
                ->with('contrato',$historico->contrato)
                ->with('peca_avulsa_alterada_id',$r->get('peca_id'))
                ->render();
            return response()->json(['tabela_pecas_avulsas'=>$html]);

        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function atualizarServico(Request $r)
    {
        try{
            $r              =   \request();
            $historico      =   Historico::find($r->get('historico_id'));
            $pivot          =   [
                'valor_liquido'=>$r->get('valor_liquido'),
                'valor_bruto'=>$r->get('valor_bruto'),
                'desconto'=>$r->get('desconto'),
                'cobrar'=>$r->get('cobrar'),
                'devolucao'=>0,

            ];

//            return $r->all();

            $historico->servicos()->updateExistingPivot(
                $r->get('servico_id'),
                ['valor_bruto'=>$r->get('valor_bruto'),'desconto'=>$r->get('desconto'),'cobrar'=>$r->get('cobrar'),'valor_liquido'=>$r->get('valor_liquido'),'devolucao'=>0]);

            $html       =   view('admin.contratos.includes.servico-tabela')
                ->with('servico_alterada_id',$r->get('servico_id'))
                ->with('contrato',$historico->contrato)->with('historico_selecionado',$historico)->render();
            return response()->json(['tabela_servicos'=>$html]);
        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    public function excluirPecaAvulsa(Request $r)
    {
        try{
            $r              =   \request();
            $historico      =   Historico::find($r->get('historico_id'));

            $peca           =   PecaAvulsa::find($r->get('peca_avulsa_id'));
            $peca->delete();
//

            $html       =   view('admin.contratos.includes.pecas-avulsas-tabela')->with('contrato',$historico->contrato)->with('historico_selecionado',$historico)->render();
            return response()->json(['tabela_pecas_avulsas'=>$html]);
        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }


    public function excluirServico(Request $r)
    {
        try{
            $r              =   \request();
            $historico      =   Historico::find($r->get('historico_id'));

            $historico->servicos()->detach($r->get('servico_id'));
//

            $html       =   view('admin.contratos.includes.servico-tabela')->with('contrato',$historico->contrato)->with('historico_selecionado',$historico)->render();
            return response()->json(['tabela_servicos'=>$html]);
        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function novoPagamento(Contrato $contrato, Historico $historico,TipoEntrada $tipo)
    {

        try{
            $dados  = [
                'titulo_pagina'    =>  'Tecvel - Adicionar Pagamento ',
                'titulo'            =>  'Novo Pagamento ',
                'titulo_card'       =>  'Dados do Pagamento',
                'contrato'           =>  $contrato,
                'historico_selecionado'   =>  $historico,
                'tipo'              =>  $tipo,
                'descricao'         =>  "Pagamento do contrato ".$contrato->id,
                'valor_original'    =>  ($contrato->valorLiquidoTotalAutorizadoPecaAvulsa()+$contrato->valorLiquidoTotalAutorizadoServico())-$contrato->valorTotaoPago(),
                'route_back'        =>  route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'pagamentos']),

            ];

            return view('admin.contratos.form.entradas',$dados);

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function gravarPagamento(Request $r,Contrato $contrato,Historico $historico)
    {
        try{
            $r              =   \request();

            $regras         =   [
                'valor_original'=>'required|numeric',
                'data'=>'required|date_format:d/m/Y',
                'descricao'=>'required',
            ];

            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $entrada = new Entrada();

            $taxa               =   TaxaEntrada::find($r->get('taxa_id'));
            $valor_original     =   $r->get('valor_original');
            $valor_cliente      =   $r->get('valor_cliente');
            $valor_loja         =   $valor_original;
            $repassar_taxa      =   $r->has('rapassar_taxa');



            $entrada            =   new Entrada();
            $entrada->gravar(
                $r->get('descricao'),
                $valor_cliente,
                $valor_original,
                $repassar_taxa,
                $r->get('data'),
                auth()->user(),
                $taxa
            );

            $historico->entradas()->attach($entrada);




            return redirect()->back()->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Cadastrado com sucesso!']);


        }catch (\Exception $e){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function atualizarPagamento(Request $r,Contrato $contrato,Historico $historico,Entrada $pagamento)
    {
        try{
            $r              =   \request();

            $regras         =   [
                'valor_original'=>'required|numeric',
                'data'=>'required|date_format:d/m/Y',
                'descricao'=>'required',
            ];

            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                return redirect()->back()->withInput()->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);
            }

            $entrada = $pagamento;

            $taxa               =   TaxaEntrada::find($r->get('taxa_id'));
            $valor_original     =   $r->get('valor_original');
            $valor_cliente      =   $r->get('valor_cliente');
            $valor_loja         =   $valor_original;
            $repassar_taxa      =   $r->has('rapassar_taxa');




            $entrada->gravar(
                $r->get('descricao'),
                $valor_cliente,
                $valor_original,
                $repassar_taxa,
                $r->get('data'),
                auth()->user(),
                $taxa
            );






            return redirect()->back()->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Cadastrado com sucesso!']);


        }catch (\Exception $e){
            return redirect()->back()->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    /**
     * @return mixed
     */
    public function editarPagamento(Contrato $contrato,Historico $historico,Entrada $pagamento)
    {
        try{
            $dados  = [
                'titulo_pagina'    =>  'Tecvel - Editar Pagamento ',
                'titulo'            =>  'Editar Pagamento ',
                'titulo_card'       =>  'Dados do Pagamento',
                'contrato'           =>  $contrato,
                'historico_selecionado'   =>  $historico,
                'tipo'              =>  $pagamento->taxa->tipo,
                'descricao'         =>  "Pagamento do contrato ".$contrato->id,
                'route_back'        =>  route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'pagamentos']),
                'entrada'           => $pagamento
            ];

            return view('admin.contratos.form.entradas',$dados);

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function excluirPagamento(Contrato $contrato,Historico $historico,Entrada $pagamento)
    {
        try{

            $pagamento->delete();
            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'pagamentos'])->with('alerta',['tipo'=>'success','icon'=>'','texto'=>'Excluido com sucesso!']);


        }catch (\Exception $e){

            return redirect()->route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico,'pagina'=>'pagamentos'])->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function visualizarPDF(Contrato $contrato)
    {
        $dados  = [
            'titulo_pagina'    =>  'Tecvel - Visualização de Contrato ',
            'titulo'            =>  'Visualizar ',
            'titulo_card'       =>  'Dados do Pagamento',
            'contrato'           =>  $contrato,


        ];
        return view('admin.contratos.includes.pdf',$dados);
    }

    public function baixarOrdemPDF(Contrato $contrato)
    {
        try{
            $dados  = [
                'titulo'        =>  'Ordem - '.$contrato->id,
            'conf'              =>  $this->conf,
            'contrato'           =>  $contrato,
            ];
            $pdf        =   Pdf::loadView('admin.contratos.pdf.contrato',$dados);
            $pdf->setPaper('A4');

            return $pdf->stream($contrato->id.'-contrato-'.(string) Str::ulid().'.pdf');


        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
    public function baixarHistoricoPDF(Contrato $contrato)
    {
        try{
            $dados  = [
                'titulo'        =>  'Histórico - '.$contrato->id,
                'conf'              =>  $this->conf,
                'contrato'           =>  $contrato,
            ];
            $pdf        =   Pdf::loadView('admin.contratos.pdf.historico',$dados);
            $pdf->setPaper('A4');

            return $pdf->stream($contrato->id.'-historico-'.(string) Str::ulid().'.pdf');


        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function baixarReciboPDF(Contrato $contrato)
    {
        try{
            $dados  = [
                'titulo'        =>  'Recibo - '.$contrato->id,
                'conf'              =>  $this->conf,
                'contrato'           =>  $contrato,
            ];
            $pdf        =   Pdf::loadView('admin.contratos.pdf.recibo',$dados);
            $pdf->setPaper('A4');

            return $pdf->stream($contrato->id.'-recibo-'.(string) Str::ulid().'.pdf');


        }catch (\Exception $e){
            return $e->getMessage();
        }
    }


}
