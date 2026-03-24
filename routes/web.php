<?php

use App\Models\Aplicativo;
use App\Models\Contrato;
use App\Models\Servico;
use App\Models\TaxaEntrada;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

//DASHBOARD
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

//USUARIOS
    Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuario.index');
    Route::get('/usuario/novo', [App\Http\Controllers\UsuarioController::class, 'novo'])->name('usuario.novo');
    Route::get('/usuario/editar/{usuario}', [App\Http\Controllers\UsuarioController::class, 'editar'])->name('usuario.editar');
    Route::post('/usuario/cadastrar', [App\Http\Controllers\UsuarioController::class, 'cadastrar'])->name('usuario.cadastrar');
    Route::post('/usuario/{usuario}/adicionar/contato', [App\Http\Controllers\UsuarioController::class, 'adicionarContato'])->name('usuario.adicionar.contato');
    Route::get('/usuario/{usuario}/remover/contato', [App\Http\Controllers\UsuarioController::class, 'removerContato'])->name('usuario.remover.contato');
    Route::post('/usuario/atualizar/{usuario}', [App\Http\Controllers\UsuarioController::class, 'atualizar'])->name('usuario.atualizar');
    Route::get('/usuario/excluir/{usuario}', [App\Http\Controllers\UsuarioController::class, 'excluir'])->name('usuario.excluir');
    Route::get('/usuario/mudar/senha', [App\Http\Controllers\UsuarioController::class, 'formularioNovaSenha'])->name('usuario.mudar.senha');
    Route::post('/usuario/cadastrar/nova/senha', [App\Http\Controllers\UsuarioController::class, 'postNovaSenha'])->name('usuario.cadastrar.nova.senha');
    Route::post('usuario/pesquisar/cliente',[App\Http\Controllers\UsuarioController::class, 'pesquisarClienteAjax'])->name('cliente.pesquisar.json');
//GRUPOS
    Route::get('/grupos', [App\Http\Controllers\GrupoController::class, 'index'])->name('grupo.index');
    Route::get('/grupo/novo', [App\Http\Controllers\GrupoController::class, 'novo'])->name('grupo.novo');
    Route::get('/grupo/editar/{grupo}', [App\Http\Controllers\GrupoController::class, 'editar'])->name('grupo.editar');
    Route::post('/grupo/cadastrar', [App\Http\Controllers\GrupoController::class, 'cadastrar'])->name('grupo.cadastrar');
    Route::post('/grupo/atualizar/{grupo}', [App\Http\Controllers\GrupoController::class, 'atualizar'])->name('grupo.atualizar');
    Route::get('/grupo/excluir/{grupo}', [App\Http\Controllers\GrupoController::class, 'excluir'])->name('grupo.excluir');

//TIPO DE ENTRADAS
    Route::get('/tiposPagamentos', [App\Http\Controllers\TipoEntradaController::class, 'index'])->name('tipoPagamento.index');
    Route::get('/tipoPagamento/novo', [App\Http\Controllers\TipoEntradaController::class, 'novo'])->name('tipoPagamento.novo');
    Route::get('/tipoPagamento/editar/{tipo}', [App\Http\Controllers\TipoEntradaController::class, 'editar'])->name('tipoPagamento.editar');
    Route::post('/tipoPagamento/cadastrar', [App\Http\Controllers\TipoEntradaController::class, 'cadastrar'])->name('tipoPagamento.cadastrar');
    Route::post('/tipoPagamento/atualizar/{tipo}', [App\Http\Controllers\TipoEntradaController::class, 'atualizar'])->name('tipoPagamento.atualizar');
    Route::get('/tipoPagamento/excluir/{tipo}', [App\Http\Controllers\TipoEntradaController::class, 'excluir'])->name('tipoPagamento.excluir');


//CATEGORIAS
    Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categoria.index');
    Route::get('/categoria/novo', [App\Http\Controllers\CategoriaController::class, 'novo'])->name('categoria.novo');
    Route::get('/categoria/editar/{categoria}', [App\Http\Controllers\CategoriaController::class, 'editar'])->name('categoria.editar');
    Route::post('/categoria/cadastrar', [App\Http\Controllers\CategoriaController::class, 'cadastrar'])->name('categoria.cadastrar');
    Route::post('/categoria/atualizar/{categoria}', [App\Http\Controllers\CategoriaController::class, 'atualizar'])->name('categoria.atualizar');
    Route::get('/categoria/excluir/{categoria}', [App\Http\Controllers\CategoriaController::class, 'excluir'])->name('categoria.excluir');


//MONTADORAS
    Route::get('/modelos', [App\Http\Controllers\ModeloController::class, 'index'])->name('modelo.index');
    Route::get('/modelo/novo', [App\Http\Controllers\ModeloController::class, 'novo'])->name('modelo.novo');
    Route::get('/modelo/editar/{modelo}', [App\Http\Controllers\ModeloController::class, 'editar'])->name('modelo.editar');
    Route::post('/modelo/cadastrar', [App\Http\Controllers\ModeloController::class, 'cadastrar'])->name('modelo.cadastrar');
    Route::post('/modelo/atualizar/{modelo}', [App\Http\Controllers\ModeloController::class, 'atualizar'])->name('modelo.atualizar');
    Route::get('/modelo/excluir/{modelo}', [App\Http\Controllers\ModeloController::class, 'excluir'])->name('modelo.excluir');

//MONTADORAS
    Route::get('/montadoras', [App\Http\Controllers\MontadoraController::class, 'index'])->name('montadora.index');
    Route::get('/montadora/novo', [App\Http\Controllers\MontadoraController::class, 'novo'])->name('montadora.novo');
    Route::get('/montadora/editar/{montadora}', [App\Http\Controllers\MontadoraController::class, 'editar'])->name('montadora.editar');
    Route::post('/montadora/cadastrar', [App\Http\Controllers\MontadoraController::class, 'cadastrar'])->name('montadora.cadastrar');
    Route::post('/montadora/atualizar/{montadora}', [App\Http\Controllers\MontadoraController::class, 'atualizar'])->name('montadora.atualizar');
    Route::get('/montadora/excluir/{montadora}', [App\Http\Controllers\MontadoraController::class, 'excluir'])->name('montadora.excluir');

//BANNERS
    Route::get('/banners', [App\Http\Controllers\BannerController::class, 'index'])->name('banner.index');
    Route::get('/banner/novo', [App\Http\Controllers\BannerController::class, 'novo'])->name('banner.novo');
    Route::get('/banner/editar/{banner}', [App\Http\Controllers\BannerController::class, 'editar'])->name('banner.editar');
    Route::post('/banner/cadastrar', [App\Http\Controllers\BannerController::class, 'cadastrar'])->name('banner.cadastrar');
    Route::post('/banner/atualizar/{banner}', [App\Http\Controllers\BannerController::class, 'atualizar'])->name('banner.atualizar');
    Route::get('/banner/excluir/{banner}', [App\Http\Controllers\BannerController::class, 'excluir'])->name('banner.excluir');

//POSTAGENNS
    Route::get('/postagens', [App\Http\Controllers\PostagemController::class, 'index'])->name('postagem.index');
    Route::get('/postagem/novo', [App\Http\Controllers\PostagemController::class, 'novo'])->name('postagem.novo');
    Route::get('/postagem/editar/{postagem}', [App\Http\Controllers\PostagemController::class, 'editar'])->name('postagem.editar');
    Route::post('/postagem/cadastrar', [App\Http\Controllers\PostagemController::class, 'cadastrar'])->name('postagem.cadastrar');
    Route::post('/postagem/atualizar/{postagem}', [App\Http\Controllers\PostagemController::class, 'atualizar'])->name('postagem.atualizar');
    Route::get('/postagem/excluir/{postagem}', [App\Http\Controllers\PostagemController::class, 'excluir'])->name('postagem.excluir');
    Route::post('/postagem/{postagem}/cadastrar/imagem', [App\Http\Controllers\PostagemController::class, 'cadastrarImagem'])->name('postagem.cadastrar.imagem');
    Route::get('/postagem/editar/{postagem}/imagem/editar/{imagem}', [App\Http\Controllers\PostagemController::class, 'editarImagem'])->name('postagem.editar.imagem');
    Route::get('/postagem/editar/{postagem}/imagem/excluir/{imagem}', [App\Http\Controllers\PostagemController::class, 'excluirImagem'])->name('postagem.excluir.imagem');
    Route::post('/postagem/editar/{postagem}/imagem/atualizar/{imagem}', [App\Http\Controllers\PostagemController::class, 'atualizarImagem'])->name('postagem.atualizar.imagem');
    Route::post('/postagem/{postagem}/cadastrar/comentario', [App\Http\Controllers\PostagemController::class, 'cadastrarComentario'])->name('postagem.cadastrar.comentario');
    Route::post('/postagem/{postagem}/cadastrar/resposta/{comentario}', [App\Http\Controllers\PostagemController::class, 'cadastrarResposta'])->name('postagem.cadastrar.resposta');

//VEICULOS
    Route::get('/veiculos', [App\Http\Controllers\VeiculoController::class, 'index'])->name('veiculo.index');
    Route::get('/veiculo/novo', [App\Http\Controllers\VeiculoController::class, 'novo'])->name('veiculo.novo');
    Route::get('/veiculo/editar/{veiculo}', [App\Http\Controllers\VeiculoController::class, 'editar'])->name('veiculo.editar');
    Route::post('/veiculo/cadastrar', [App\Http\Controllers\VeiculoController::class, 'cadastrar'])->name('veiculo.cadastrar');
    Route::post('/veiculo/atualizar/{veiculo}', [App\Http\Controllers\VeiculoController::class, 'atualizar'])->name('veiculo.atualizar');
    Route::get('/veiculo/excluir/{veiculo}', [App\Http\Controllers\VeiculoController::class, 'excluir'])->name('veiculo.excluir');
    Route::post('/veiculo/pesquisar/cliente',[App\Http\Controllers\VeiculoController::class, 'pesquisarVeiculoAjax'])->name('veiculo.pesquisar.json');

//MODELO
    Route::post('/modelo/pesquisar',[App\Http\Controllers\ModeloController::class, 'pesquisarModeloAjax'])->name('modelo.pesquisar.json');

//CONTRATOS
    Route::get('/contratos', [App\Http\Controllers\ContratoController::class, 'index'])->name('contrato.index');
    Route::get('/contrato/novo', [App\Http\Controllers\ContratoController::class, 'novo'])->name('contrato.novo');
    Route::get('/contrato/editar/{contrato}/historico/{historico}', [App\Http\Controllers\ContratoController::class, 'editar'])->name('contrato.editar');
    Route::post('/contrato/cadastrar', [App\Http\Controllers\ContratoController::class, 'cadastrar'])->name('contrato.cadastrar');
    Route::post('/contrato/atualizar/{contrato}/historico/{historico}', [App\Http\Controllers\ContratoController::class, 'atualizar'])->name('contrato.atualizar');
    Route::get('/contrato/excluir/{contrato}', [App\Http\Controllers\ContratoController::class, 'excluir'])->name('contrato.excluir');
    Route::post('/contrato/mudar/status/{contrato}', [App\Http\Controllers\ContratoController::class, 'mudarStatus'])->name('contrato.mudar.status');
    Route::post('/contrato/{contrato}/historico/editar/{historico}/',[App\Http\Controllers\HistoricoController::class, 'atualziar'])->name('contrato.editar.historico');
    Route::get('/contrato/editar/{contrato}/historico/{historico}/registro/novo',[App\Http\Controllers\RegistroController::class, 'novo'])->name('contrato.registro.novo');
    Route::get('/contrato/editar/{contrato}/historico/{historico}/registro/editar/{registro}',[App\Http\Controllers\RegistroController::class, 'editar'])->name('contrato.registro.editar');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/registro/cadastrar',[App\Http\Controllers\RegistroController::class, 'cadastrar'])->name('contrato.registro.cadastrar');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/registro/atualizar/{registro}',[App\Http\Controllers\RegistroController::class, 'atualizar'])->name('contrato.registro.atualizar');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/registro/atualizar/{registro}/adicionar/imagens',[App\Http\Controllers\RegistroController::class, 'adicionarImagens'])->name('contrato.registro.adicionar.imagens');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/registro/atualizar/imagem/{imagem}',[App\Http\Controllers\RegistroController::class, 'atualizarImagem'])->name('contrato.registro.atualizar.imagem');
    Route::get('/contrato/editar/{contrato}/historico/{historico}/registro/excluir/{registro}', [App\Http\Controllers\RegistroController::class, 'excluir'])->name('contrato.registro.excluir');
    Route::get('/contrato/editar/{contrato}/historico/{historico}/registro/{registro}/imagem/{imagem}', [App\Http\Controllers\RegistroController::class, 'excluirImagem'])->name('contrato.registro.imagem.excluir');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/servico/adicionar',[App\Http\Controllers\ContratoController::class, 'adicionarServico'])->name('contrato.servico.adicionar');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/peca/adicionar',[App\Http\Controllers\ContratoController::class, 'adicionarPecaAvulsa'])->name('contrato.pecaavulsa.adicionar');
    Route::post('/contrato/peca/atualizar',[App\Http\Controllers\ContratoController::class, 'atualizarPecaAvulsa'])->name('contrato.pecaavulsa.atualizar');
    Route::post('/contrato/pecaavulsa/excluir',[App\Http\Controllers\ContratoController::class, 'excluirPecaAvulsa'])->name('contrato.pecaavulsa.excluir');
    Route::post('/contrato/servico/atualizar',[App\Http\Controllers\ContratoController::class, 'atualizarServico'])->name('contrato.servico.atualizar');
    Route::post('/contrato/servico/excluir',[App\Http\Controllers\ContratoController::class, 'excluirServico'])->name('contrato.servico.excluir');
    Route::get('/contrato/editar/{contrato}/historico/{historico}/pagamento/novo/{tipo}', [App\Http\Controllers\ContratoController::class, 'novoPagamento'])->name('contrato.pagamento.novo');
    Route::get('/contrato/editar/{contrato}/historico/{historico}/pagamento/editar/{pagamento}', [App\Http\Controllers\ContratoController::class, 'editarPagamento'])->name('contrato.pagamento.editar');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/entrada/gravar', [App\Http\Controllers\ContratoController::class, 'gravarPagamento'])->name('contrato.pagamento.gravar');
    Route::post('/contrato/editar/{contrato}/historico/{historico}/entrada/atualizar/{pagamento}', [App\Http\Controllers\ContratoController::class, 'atualizarPagamento'])->name('contrato.pagamento.atualizar');
    Route::get('/contrato/editar/{contrato}/historico/{historico}/entrada/excluir/{pagamento}', [App\Http\Controllers\ContratoController::class, 'excluirPagamento'])->name('contrato.pagamento.excluir');
    Route::get('/contrato/{contrato}/visualizar/ordem', [App\Http\Controllers\ContratoController::class, 'visualizarPDF'])->name('contrato.visualizar.pdf');
    Route::get('/contrato/{contrato}/baixar/ordem/pdf', [App\Http\Controllers\ContratoController::class, 'baixarOrdemPDF'])->name('contrato.baixar.contrato.pdf');
    Route::get('/contrato/{contrato}/baixar/historico/pdf', [App\Http\Controllers\ContratoController::class, 'baixarHistoricoPDF'])->name('contrato.baixar.historico.pdf');
    Route::get('/contrato/{contrato}/baixar/recibo/pdf', [App\Http\Controllers\ContratoController::class, 'baixarReciboPDF'])->name('contrato.baixar.recibo.pdf');


//SERVIÇOS
    Route::post('/servicos/pesquisar', [App\Http\Controllers\ServicoController::class, 'pesquisarServicoAjax'])->name('servico.pesquisar.json');

//TAXAS
    Route::post('/taxa/entrada/renderizar/pagina', [App\Http\Controllers\TaxaEntradaController::class, 'renderizarPagina'])->name('taxa.rendereizar.pagina');
    Route::post('taxa/pegar/valor/taxa', [App\Http\Controllers\TaxaEntradaController::class, 'pegarValorTaxa'])->name('taxa.pegar.valor.taxa');

//ENTRADAS
    Route::post('/entrada/gravar', [App\Http\Controllers\EntradaController::class, 'gravar'])->name('entrada.gravar');

});
Route::get('/montadora/{id}/modelos', [App\Http\Controllers\MontadoraController::class, 'modelos'])->name('montadora.modelos.ajax');

Route::get('/fazer-orcamento', [\App\Http\Controllers\SiteController::class,'fazerOrcamento'])->name('site.fazer.orcamento');
Route::get('/', [\App\Http\Controllers\SiteController::class,'index'])->name('site.index');
Route::post('/cadastrar-orcamento', [\App\Http\Controllers\SiteController::class,'cadastrarOrcamento'])->name('site.cadastrar.orcamento');

Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::post('/logar', [App\Http\Controllers\LoginController::class, 'logar'])->name('logar');

View::composer(['admin.usuarios.includes.form','admin.usuarios.index'],function($view){
    $grupos    =   \App\Models\Grupo::visiveis()->get();

    $view->with(['grupos'=>$grupos]);
});

View::composer(['admin.grupos.formulario'],function($view){
    $permissoes    =   \App\Models\Permissao::all();

    $view->with(['permissoes'=>$permissoes]);
});

View::composer(['site.fazer-orcamento','admin.modelos.formulario','admin.modelos.index'],function($view){
    $montadoras    =   \App\Models\Montadora::all();

    $view->with(['montadoras'=>$montadoras]);
});

View::composer(['admin.veiculos.includes.form','admin.veiculos.index'],function($view){
    $modelos    =   \App\Models\Modelo::all();

    $view->with(['modelos'=>$modelos]);
});

View::composer(['admin.contratos.form.registro'],function($view){
    $tipos          =   \App\Models\TipoRegistro::all();

    $view->with(['tipos_registros'=>$tipos]);
});

View::composer(['admin.contratos.includes.pagamentos'],function($view){
    $tipos_entradas    =   \App\Models\TipoEntrada::ativo();

    $view->with(['tipos_entradas'=>$tipos_entradas]);
});

View::composer(['admin.postagens.formulario'],function($view){
    $categorias         =   \App\Models\CategoriaPostagem::status(1)->get();

    $view->with(['categorias'=>$categorias]);
});

Route::get('/teste', function (){
   $cliente     =   \App\Models\User::find(1);

   return $cliente->contatos()->where('numero','85988')->exists() == false;
});
