<?php

use App\Models\Aplicativo;
use App\Models\Contrato;
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

//CONTRATOS
    Route::get('/contratos', [App\Http\Controllers\ContratoController::class, 'index'])->name('contrato.index');
    Route::get('/contrato/novo', [App\Http\Controllers\ContratoController::class, 'novo'])->name('contrato.novo');
    Route::get('/contrato/editar/{contrato}/historico/{historico}', [App\Http\Controllers\ContratoController::class, 'editar'])->name('contrato.editar');
    Route::post('/contrato/cadastrar', [App\Http\Controllers\ContratoController::class, 'cadastrar'])->name('contrato.cadastrar');
    Route::post('/contrato/atualizar/{contrato}/historico/{historico}', [App\Http\Controllers\ContratoController::class, 'atualizar'])->name('contrato.atualizar');
    Route::get('/contrato/excluir/{contrato}', [App\Http\Controllers\ContratoController::class, 'excluir'])->name('contrato.excluir');
    Route::post('/contrato/mudar/status/{contrato}', [App\Http\Controllers\ContratoController::class, 'mudarStatus'])->name('contrato.mudar.status');

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

Route::get('/', function () {
    $c          =   Contrato::find(2);

    dd($c->historicos);
});
