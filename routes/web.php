<?php

use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\NaturezaController;
use App\Http\Controllers\UnidadeAdministrativaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ParticipanteController;
use \App\Http\Controllers\AcaoController;
use \App\Http\Controllers\CertificadoModeloController;
use \App\Http\Controllers\CertificadoController;
use \App\Http\Controllers\TipoNaturezaController;
use \App\Http\Controllers\AssinaturaController;
use App\Models\UnidadeAdministrativa;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', 'HomeController@index');

Route::get(
    'logout',
    function(Request $request){
        Auth::logout();
        Session::flush();
        return redirect(route('home'));
    })->name('login.logout');

Route::group(['middleware' => 'checkAdministrador'], function ()
{
    Route::get('/administrador', [UsuarioController::class, 'home_administrador'])->name('administrador.index');


    Route::get('/unidade_administrativa/index', [UnidadeAdministrativaController::class, 'index'])->name('unidade_administrativa.index');

    Route::get('/unidade_administrativa/create',[UnidadeAdministrativaController::class, 'create'])->name('unidade_administrativa.create');
    Route::post('/unidade_administrativa/store',[UnidadeAdministrativaController::class, 'store'])->name('unidade_administrativa.store');

    Route::get('/unidade_administrativa_edit/{unidade_administrativa_id}', [UnidadeAdministrativaController::class, 'edit'])->name('unidade_administrativa.edit');
    Route::post('/unidade_administrativa/update', [UnidadeAdministrativaController::class, 'update'])->name('unidade_administrativa.update');

    Route::get('/unidade_administrativa/{unidade_administrativa_id}/delete', [UnidadeAdministrativaController::class, 'delete'])->name('unidade_administrativa.delete');


    Route::get('/tipo_natureza/index', [TipoNaturezaController::class, 'show'])->name('tipo_natureza.index');

    Route::get('/tipo_natureza/create', [TipoNaturezaController::class, 'create'])->name('tipo_natureza.create');
    Route::post('/store_tipo_natureza', [TipoNaturezaController::class, 'store'])->name('tipo_natureza.store');

    Route::get('/tipo_natureza/{id}/edit', [TipoNaturezaController::class, 'edit'])->name('tipo_natureza.edit');
    Route::put('/tipo_natureza/{id}/update', [TipoNaturezaController::class, 'update'])->name('tipo_natureza.update');

    Route::get('/tipo_naturezas/delete/{id}', [TipoNaturezaController::class, 'destroy'])->name('tipo_natureza.delete');


    Route::get('/natureza/index', [NaturezaController::class, 'index'])->name('natureza.index');

    Route::get('/natureza/create', [NaturezaController::class, 'create'])->name('natureza.create');
    Route::post('/natureza/store', [NaturezaController::class, 'store'])->name('natureza.store');

    Route::get('/natureza_edit/{natureza_id}', [NaturezaController::class, 'edit'])->name('natureza.edit');
    Route::post('/natureza_update', [NaturezaController::class, 'update'])->name('natureza.update');

    Route::get('/natureza/{natureza_id}/delete', [NaturezaController::class, 'delete'])->name('natureza.delete');


    Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');

    Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
    Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');

    Route::get('/usuario/edit/{usuario_id}', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::post('/usuario/update', [UsuarioController::class, 'update'])->name('usuario.update');

    Route::get('/usuario/{usuario_id}/delete', [UsuarioController::class, 'delete'])->name('usuario.delete');


    Route::get('/certificado_modelo/index', [CertificadoModeloController::class, 'index'])->name('certificado_modelo.index');
    Route::get('/certificado_modelo/create', [CertificadoModeloController::class, 'create'])->name('certificado_modelo.create');
    Route::post('/store_certificado_modelo', [CertificadoModeloController::class, 'store'])->name('certificado_modelo.store');
});

Route::get('/certificado_modelo/{id}/edit', [CertificadoModeloController::class, 'edit'])->name('certificado_modelo.edit');
Route::put('/certificado_modelo/{id}/update', [CertificadoModeloController::class, 'update'])->name('certificado_modelo.update');
Route::get('/certificado_modelo/delete/{id}', [CertificadoModeloController::class, 'destroy'])->name('certificado_modelo.delete');
Route::get('certificado_modelo/{id}/{imagem}/img',[CertificadoModeloController::class, 'showImg'])->name('certificado_modelo.show_img');
Route::get('/certificado_modelo/{id}/show', [CertificadoModeloController::class, 'show'])->name('certificado_modelo.show');
Route::get('/certificado_modelo/index', [CertificadoModeloController::class, 'index'])->name('certificado_modelo.index');


Route::group(['middleware' => 'checkCoordenadorGestor'], function ()
{
    Route::get('/acao/create', [AcaoController::class, 'create'])->name('acao.create');

    Route::get('/acao', [AcaoController::class, 'index'])->name('acao.index');

    Route::post('/acao/store', [AcaoController::class, 'store'])->name('acao.store');

    Route::get('/acao/edit/{acao_id}', [AcaoController::class, 'edit'])->name('acao.edit');
    Route::post('/acao/update', [AcaoController::class, 'update'])->name('acao.update');

    Route::get('/acao/{acao_id}/delete', [AcaoController::class, 'delete'])->name('acao.delete');

    Route::get('/acao/submeter/{acao_id}', [AcaoController::class, 'submeter_acao'])->name('acao.submeter');


    Route::get('acao/{acao_id}/atividade/', [AtividadeController::class, 'index'])->name('atividade.index');

    Route::get('acao/{acao_id}/atividade/create/', [AtividadeController::class, 'create'])->name('atividade.create');
    Route::post('atividade/store', [AtividadeController::class, 'store'])->name('atividade.store');

    Route::get('atividade/{atividade_id}/edit', [AtividadeController::class, 'edit'])->name('atividade.edit');
    Route::post('atividade/update', [AtividadeController::class, 'update'])->name('atividade.update');

    Route::get('atividade/{atividade_id}/delete', [AtividadeController::class, 'delete'])->name('atividade.delete');


    Route::get('/participante/index/{atividade_id}', [ParticipanteController::class, 'index'])->name('participante.index');

    Route::get('/participante/create/{atividade_id}', [ParticipanteController::class, 'create'])->name('participante.create');
    Route::post('/participante/store', [ParticipanteController::class, 'store'])->name('participante.store');

    Route::get('/participante/edit/{participante_id}', [ParticipanteController::class, 'edit'])->name('participante.edit');
    Route::post('/participante/update', [ParticipanteController::class, 'update'])->name('participante.update');

    Route::get('/participante/{participante_id}/delete', [ParticipanteController::class, 'delete'])->name('participante.delete');

    Route::get('/participante/certificado{participante_id}', [CertificadoController::class, 'ver_certificado'])->name('participante.ver_certificado');

    Route::get('/gestor/analisar_acao/{acao_id}/anexo', [AcaoController::class, 'download_anexo'])->name('anexo.download');

    Route::get('/acao/{acao_id}/atividade/gerar-certificados', [AcaoController::class, 'download_certificados'])->name('certificados.download');

});

Route::group(['middleware' => 'checkGestorInstitucional'], function () {
    Route::get('/gestor', [UsuarioController::class, 'home_gestor'])->name('home.gestor');

    Route::get('/gestor/acoes', [AcaoController::class, 'acoes_submetidas'])->name('gestor.acoes_submetidas');

    Route::get('/gestor/analisar_acao/{acao_id}', [AcaoController::class, 'analisar_acao'])->name('gestor.analisar_acao');

    Route::get('/gestor/analisar_acao/participantes/{atividade_id}', [ParticipanteController::class, 'participantes_atividade'])->name('gestor.participantes_atividade');

    Route::post('/gestor/acao/update', [AcaoController::class, 'acao_update'])->name('gestor.acao_update');

    Route::get('/tipo_certificado_modelo/create', [CertificadoModeloController::class, 'create_tipo_certificado'])->name('tipo_certificado_modelo.create');
    Route::post('/store_tipo_certificado_modelo', [CertificadoModeloController::class, 'store_tipo_certificado'])->name('tipo_certificado_modelo.store');

    Route::get('/gestor/gerar_certificados{acao_id}', [CertificadoController::class, 'gerar_certificados'])->name('gestor.gerar_certificados');
});

Route::get('/acao/list', [AcaoController::class, 'list'])->name('acao.list');


Route::get('/assinatura/create', [AssinaturaController::class, 'create'])->name('assinatura.create');
Route::post('/store_assinatura', [AssinaturaController::class, 'store'])->name('assinatura.store');
Route::get('/assinaturas', [AssinaturaController::class, 'show'])->name('assinatura.show');
Route::get('/assinatura/{id}/edit', [AssinaturaController::class, 'edit'])->name('assinatura.edit');
Route::put('/assinatura/{id}/update', [AssinaturaController::class, 'update'])->name('assinatura.update');
Route::get('/assinatura/delete/{id}', [AssinaturaController::class, 'destroy'])->name('assinatura.delete');


Route::get('/certificado/create', [CertificadoController::class, 'create'])->name('certificado.create');
Route::post('/store_certificado', [CertificadoController::class, 'store'])->name('certificado.store');
Route::get('/certificados', [CertificadoController::class, 'show'])->name('certificado.show');
Route::get('/certificado/{id}/edit', [CertificadoController::class, 'edit'])->name('certificado.edit');
Route::put('/certificado/{id}/update', [CertificadoController::class, 'update'])->name('certificado.update');
Route::get('/certificado/delete/{id}', [CertificadoController::class, 'destroy'])->name('certificado.delete');


Route::get('/validacao', [CertificadoController::class, 'validar_certificado'])->name('validar_certificado.validar');
Route::post('/validacao/checar', [CertificadoController::class, 'checar_certificado'])->name('validar_certificado.checar');
Route::get('/validacao/{codigo_validacao}', [CertificadoController::class, 'checar_certificado_qr'])->name('validar_certificado.checar_qr');
