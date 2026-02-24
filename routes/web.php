<?php

use App\Models\Aplicativo;
use App\Models\Contrato;
use App\Models\Servico;
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
    Route::post('/contrato/servico/atualizar',[App\Http\Controllers\ContratoController::class, 'atualizarServico'])->name('contrato.servico.atualizar');
    Route::post('/contrato/servico/excluir',[App\Http\Controllers\ContratoController::class, 'excluirServico'])->name('contrato.servico.excluir');

//SERVIÇOS
    Route::post('/servicos/pesquisar', [App\Http\Controllers\ServicoController::class, 'pesquisarServicoAjax'])->name('servico.pesquisar.json');

});

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

View::composer(['admin.veiculos.includes.form','admin.veiculos.index'],function($view){
    $modelos    =   \App\Models\Modelo::all();

    $view->with(['modelos'=>$modelos]);
});

View::composer(['admin.contratos.form.registro'],function($view){
    $tipos          =   \App\Models\TipoRegistro::all();

    $view->with(['tipos_registros'=>$tipos]);
});

Route::get('/', function () {



    $historico  =   \App\Models\Historico::find(1);
    $historico->servicos()->updateExistingPivot(3,
        ['valor_bruto'=>1,'desconto'=>1,'cobrar'=>1,'valor_liquido'=>2,'devolucao'=>0]);
});
