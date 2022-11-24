<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ParticipanteController;
use \App\Http\Controllers\AcaoController;
use \App\Http\Controllers\TipoNaturezaController;
use \App\Http\Controllers\AssinaturaController;
use App\Http\Controllers\UnidadeAdminstrativaController;
use App\Models\UnidadeAdministrativa;

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

Route::get('/participante_create', [ParticipanteController::class, 'create'])->name('participante.create');
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/acaos', [AcaoController::class, 'create'])->name('acao.create');
Route::post('/acaos_store', [AcaoController::class, 'store'])->name('acao.store');


Route::get('/tipo_natureza/create', [TipoNaturezaController::class, 'create'])->name('tipo_natureza.create');
Route::post('/store_tipo_natureza', [TipoNaturezaController::class, 'store'])->name('tipo_natureza.store');

Route::get('/tipo_naturezas', [TipoNaturezaController::class, 'show'])->name('tipo_natureza.show');

Route::get('/tipo_natureza/{id}/edit', [TipoNaturezaController::class, 'edit'])->name('tipo_natureza.edit');
Route::put('/tipo_natureza/{id}/update', [TipoNaturezaController::class, 'update'])->name('tipo_natureza.update');

Route::get('/tipo_naturezas/delete/{id}', [TipoNaturezaController::class, 'destroy'])->name('tipo_natureza.delete');



Route::get('/assinatura/create', [AssinaturaController::class, 'create'])->name('assinatura.create');
Route::post('/store_assinatura', [AssinaturaController::class, 'store'])->name('assinatura.store');

Route::get('/assinaturas', [AssinaturaController::class, 'show'])->name('assinatura.show');

Route::get('/assinatura/{id}/edit', [AssinaturaController::class, 'edit'])->name('assinatura.edit');
Route::put('/assinatura/{id}/update', [AssinaturaController::class, 'update'])->name('assinatura.update');

Route::get('/assinatura/delete/{id}', [AssinaturaController::class, 'destroy'])->name('assinatura.delete');


Route::get('/unidade_administrativa',[UnidadeAdminstrativaController::class, 'create'])->name('unidade_administrativa.create');
