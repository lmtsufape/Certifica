<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ParticipanteController;
use \App\Http\Controllers\AcaoController;
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
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/participante_create', [ParticipanteController::class, 'create'])->name('participante.create');
Route::post('/participante_store', [ParticipanteController::class, 'store'])->name('participante.store');
Route::get('/participante_index', [ParticipanteController::class, 'index'])->name('participante.index');
Route::get('/participante_edit/{participante_id}', [ParticipanteController::class, 'edit'])->name('participante.edit');
Route::post('/participante_update', [ParticipanteController::class, 'update'])->name('participante.update');
Route::get('/instituicao/{participante_id}/delete', [ParticipanteController::class, 'delete'])->name('participante.delete');


Route::get('/acaos', [AcaoController::class, 'create'])->name('acao.create');
Route::post('/acaos_store', [AcaoController::class, 'store'])->name('acao.store');

Route::get('/unidade_administrativa',[UnidadeAdminstrativaController::class, 'create'])->name('unidade_administrativa.create');
