<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CategoriaPostagem;
use App\Models\Comentario;
use App\Models\Configuracao;
use App\Models\Contato;
use App\Models\Contrato;
use App\Models\Montadora;
use App\Models\Postagem;
use App\Models\Registro;
use App\Models\RegistroImagem;
use App\Models\User;
use App\Models\Veiculo;
use App\Models\Whatsapp;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use SamuelTerra22\LaravelEvolutionClient\src\Facades\Evolution;


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
            'meta_descricao'          =>  $this->conf->meta_descricao,
            'meta_keywords'          =>  $this->conf->meta_keywords,
            'cat'            =>  CategoriaPostagem::all(),
        ];
        return view('site.home', $dados);
    }

    public function categoria($link)
    {
        $categoria      =   CategoriaPostagem::where('nome_link', $link)->first();
        if ($categoria == null) {
            return redirect()->route('site.404');
        }
        $dados = [
            'conf'      =>  $this->conf,
            'categoria' =>  $categoria,
            'postagens' =>  $categoria->postagens()->paginate(6),
            'titulo'    =>  $categoria->nome,
            'titulo_pagina' =>  $categoria->nome,
            'meta_descricao'          =>  $categoria->meta_descricao,
            'meta_keywords'          =>  $categoria->meta_keywords,
            'postagens_recentes'        =>  Postagem::pesquisarPorStatus(1)->orderBy('created_at','desc')->take(5)->get(),

        ];
        return view('site.postagens', $dados);
    }

    public function postagens()
    {
        $pesquisa       =   \request()->input('pesquisa');
        $dados  =[
            'conf'          =>  $this->conf,
            'postagens'     =>  Postagem::PesquisarPorStatus(1)->PesquisarPorTitulo($pesquisa)->paginate(6),
            'titulo'    =>  'Pesquisa de postagens',
            'titulo_pagina' =>  'Pesquisa : '.$pesquisa,
            'postagens_recentes'        =>  Postagem::pesquisarPorStatus(1)->orderBy('created_at','desc')->take(5)->get(),
        ];


        return view('site.postagens', $dados);
    }
    public function postagem($link)
    {
        $postagem  =   Postagem::where('titulo_link', $link)->first();

        if ($postagem == null) {
            return redirect()->route('site.404');
        }
        $dados = [
            'conf'      =>  $this->conf,
            'postagem'  =>  $postagem,
            'comentarios'   =>  $postagem->comentarios()->pesquisarPorStatus(1)->get(),
            'titulo'    =>  $postagem->titulo,
            'titulo_pagina' =>  $postagem->titulo,
            'postagens_recentes'        =>  Postagem::pesquisarPorStatus(1)->orderBy('created_at','desc')->take(5)->get(),
            'meta_descricao'          =>  $postagem->meta_descricao,
            'meta_keywords'          =>  $postagem->meta_keywords,

        ];
        $postagem->adicionarVisita();
        return view('site.postagem', $dados);
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
                'imagens[]'=>'image|mimes:jpg,png,jpeg',
            ];


            $validacao      =   Validator::make($r->all(),$regras);
            if($validacao->fails()){
                $montadora          =   Montadora::find($r->input('montadora'));
                $modelos            =   $montadora->modelos;

                return redirect()->route('site.fazer.orcamento')->withInput()->withErrors($validacao)->with('modelos_retorno',$modelos)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."]);

            }
            $cliente        =   User::where('email',$r->input('email'))->first();
            $numero         =   Contato::limparNumero($r->input('contato'));

            if($cliente == null){
                $cliente    =   new User();
//                $nome, $email,  $grupo_id,$ativo,$senha =null,$contato=null,$whatapp=null, $descricao=null
                $cliente->gravar(
                    $r->input('nome'),
                    $r->input('email'),
                    $this->conf->grupo_cliente_id,
                    '1',
                    '123456789',
                    $numero,
                    1,
                );
            }else{
                if($cliente->contatos()->where('numero',$numero)->exists() == false){
                    $cliente->adicionarContato($numero,1,'');
                }
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
            if($r->has('imagens')){
                foreach ($r->file('imagens') as $i){
                    $imagem         =   new RegistroImagem();
                    $imagem->gravar(
                        $registro,
                        $i,
                        null
                    );
                }


            }

            /*$os_numero = $contrato->id;
            $cliente = $contrato->cliente->name;
            $aparelho = $contrato->veiculo->placa.' - '.$contrato->veiculo->modelo->nome;
            $defeito = $r->input('descricao');
            $data_entrega = Carbon::now()->format('d/m/Y');

// 3. Montando o texto com formatação WhatsApp
// *texto* = Negrito | ```texto``` = Fonte Monoespaçada | \n = Quebra de linha
            $mensagem = "🛠️ *SOLICITAÇÃO DE ORÇAMENTO* 🛠️\n\n";
            $mensagem .= "📌 *Número da O.S.:* ```{$os_numero}```\n";
            $mensagem .= "👤 *Cliente:* {$cliente}\n";
            if ($contrato->veiculo != null){
                $mensagem .= "📱 *Veículo:* {$aparelho}\n";
            }

            $mensagem .= "----------------------------------\n";
            $mensagem .= "📝 *Defeito Relatado:*\n";
            $mensagem .= "_{$defeito}_\n\n";
//            $mensagem .= "💰 *Valor Total:* *{$valor}*\n";
            $mensagem .= "📅 *Previsão de Entrega:* {$data_entrega}\n\n";
            $mensagem .= "✅ _Para aprovar o orçamento, responda esta mensagem._";
            $zap    =   new Whatsapp();
            $zap->enviarMensagem($mensagem,'85986607785','+55');*/
            return redirect()->back()->with('alerta',['tipo'=>'success','icon'=>'','texto'=>"Cadastrado com sucesso!."]);


        }catch (\Exception $e){
            return redirect()->route('site.fazer.orcamento')->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>$e->getMessage()]);
        }
    }

    public function paginanaoencontrada()
    {
        $dados  =   [
            'conf'          =>  $this->conf,
        ];
        return view('site.includes.error404',$dados);
    }

    public function comentar()
    {
        try{

            $r      =   request();
            $regras         =   [
                'nome'=>'required',
                'email'=>'required|email',
                'whatsapp'=>'required',
                'conteudo'=>'required'
            ];

            $validacao      =   Validator::make($r->all(),$regras);

            if($validacao->fails()){
                $postagem       =   Postagem::find($r->input('postagem_id'));
                $dados          =   [
                    'postagem'  =>      $postagem,
                    'comentarios'   =>  $postagem->comentarios,
                ];
                    $html       =   view('site.includes.comentarios',$dados)
                    ->with('nome',$r->input('nome'))
                    ->with('email',$r->input('email'))
                    ->with('whatsapp',$r->input('whatsapp'))
                    ->with('conteudo',$r->input('conteudo'))
                    ->withErrors($validacao)->with('alerta',['tipo'=>'danger','icon'=>'','texto'=>"Preencher os campos obrigatórios!."])
                        ->render();
                return response()->json(['comentarios'=>$html]);

            }

            $cliente        =   User::where('email',$r->input('email'))->first();
            $numero         =   Contato::limparNumero($r->input('whatsapp'));

            if($cliente == null){
                $cliente    =   new User();
                $cliente->gravar(
                    $r->input('nome'),
                    $r->input('email'),
                    $this->conf->grupo_cliente_id,
                    1,
                    '123456789',
                    $numero,
                    1,
                );
            }else{
                if($cliente->contatos()->where('numero',$numero)->exists() == false){
                    $cliente->adicionarContato($numero,1,'');
                }
            }
            $comentario   =   new Comentario();
            $comentario->salvar(
                $r->input('conteudo'),
                $cliente,
                1
            );

            $postagem       =   Postagem::find($r->input('postagem_id'));
            $postagem->comentarios()->attach($comentario);
            $dados          =   [
                'postagem'  =>      $postagem,
                'comentarios'   =>  $postagem->comentarios,
            ];
            $html       =   view('site.includes.comentarios',$dados);
            return response()->json(['comentarios'=>$html->with('success','Castrado com sucesso')->render()]);

        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }

    }

    public function teste()
    {
        $contrato       =   Contrato::find(1);
        return $contrato->historicos->map->indicacoes->flatten();


        /*try {
            $dados = [
                'titulo' => 'Ordem - ',
                'conf' => $this->conf,
                'contrato' => $contrato,
            ];
            $zap = new Whatsapp();
            $pdf = Pdf::loadView('admin.contratos.pdf.contrato', $dados);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
            $output = $pdf->output();

            foreach ($contrato->historicos as $historico) {$mensagem = "*Olá! Segue seu resumo:*\n\n";
                // 2. Dados da Ordem de Serviço (Exemplo)
                $os_numero = "2024-0015";
                $cliente = "João Silva";
                $aparelho = "iPhone 13 Pro";
                $defeito = "Troca de tela e conector de carga";
                $valor = "R$ 850,00";
                $data_entrega = "28/03/2024";

// 3. Montando o texto com formatação WhatsApp
// *texto* = Negrito | ```texto``` = Fonte Monoespaçada | \n = Quebra de linha
                $mensagem = "🛠️ *ORDEM DE SERVIÇO* 🛠️\n\n";
                $mensagem .= "📌 *Protocolo:* ```{$os_numero}```\n";
                $mensagem .= "👤 *Cliente:* {$cliente}\n";
                $mensagem .= "📱 *Equipamento:* {$aparelho}\n";
                $mensagem .= "----------------------------------\n";
                $mensagem .= "📝 *Defeito Relatado:*\n";
                $mensagem .= "_{$defeito}_\n\n";
                $mensagem .= "💰 *Valor Total:* *{$valor}*\n";
                $mensagem .= "📅 *Previsão de Entrega:* {$data_entrega}\n\n";
                $mensagem .= "✅ _Para aprovar o orçamento, responda esta mensagem._";
                $zap->enviarMensagem($mensagem,'85986607785','+55');
                foreach ($historico->registros->map->imagens->flatten() as $imagem){
                    echo $imagem;
                    $zap = new Whatsapp();
                $img = url()->asset('layout/imagens/registros/' . $imagem->nome);
                echo url()->asset('layout/imagens/registros/' . $imagem->nome);
//
                $zap->enivarMensagemMedia(base64_encode(file_get_contents($img)), '85986607785', $imagem->descricao, $imagem->nome, '2', '+55', 'image');
                }
            }
*/

//            return $zap->enivarMensagemMedia(base64_encode($output),'85986607785','Contrato','contrato.pdf','2','+55','document');

/*
        }catch (\Exception $e){
            return $e->getMessage();
        }*/
    }

}
