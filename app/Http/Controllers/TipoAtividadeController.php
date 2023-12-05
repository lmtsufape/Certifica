<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoAtividadeController extends Controller
{
    public function index(){
        return view('tipo_atividade.index');
    }
    public function create(){
        return view('tipo_atividade.create');
    }
    public function store(){
        dd('store method');
    }
    public function edit(){
        return view('tipo_atividade.edit');
    }
    public function update(){
        dd('update method');
    }
    public function destroy(){
        dd('delete method');
    }
}
