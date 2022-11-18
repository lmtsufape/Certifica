<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ParticipanteController;

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
    return view('participante.participante_create');
});

