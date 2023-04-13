@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')

        <h1 class="text-center">Cadastrar ação</h1>
        <form class="container form" action="{{ Route('acao.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf

            <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="unidade_administrativa_id" value="{{ Auth::user()->unidade_administrativa_id }}">

            <div class="row d-flex justify-content-start">
                <div class="spacing-row1 col-5 input-create-box">
                    <span class="tittle-input">Título</span><input class="w-75" type="text" name="titulo" id="">
                </div>
                <div class="col-3 spacing-row1 input-create-box">
                    <span class="tittle-input">Data I</span><input class="w-75" type="date" name="data_inicio" id="">
                </div>
                <div class="col-3 input-create-box">
                    <span class="tittle-input">Data F</span><input class="w-75" type="date" name="data_fim" id="">
                </div>
            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="spacing-row2 col-4 input-create-box">
                    <span class="tittle-input-2">Natureza</span>
                    <select class="select-form" name="natureza_id" id="">
                        @foreach($naturezas as $natureza)
                            <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class=" spacing-row2 col-3 input-create-box">
                    <span class="tittle-input-2">Tipo</span><input class="w-75" type="text" name="" id="">
                </div>
                <div class="spacing-row2 col-2 input-create-box">
                    <span class="tittle-input-2 teste">Nº processo</span><input class="w-50 input-nprocesso" type="text" name="" id="">
                </div>
                <div class="col-2 input-create-box">
                    <span class="tittle-input-2">Nº edital</span><input class="w-50 input-nedital" type="text" name="" id="">
                </div>
            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="spacing-row3 col-7 input-create-box-3">
                    <span class="tittle-input-2">Observações</span><input class="observacoes-input w-75" type="text" name="" id="">
                </div>
                <div class="col-4 input-create-box-3 border-0 d-flex flex-column justify-content-between">
                    <input type="file" name="anexo" id="">
                    <div class="border d-flex justify-content-end">
                        [icon]
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="d-flex justify-content-center align-items-center cancel" href={{ route('home') }}>Cancelar</a> 
                    <button class="submit" type="submit" >Submeter</button>
                </div>
        
            </div>

        </form>
    </section>
   
@endsection