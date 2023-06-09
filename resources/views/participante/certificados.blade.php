@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <h1 class="text-center mb-4">Meus Certificados</h1>

            <div class="container">

                <div class="row head-table search-box d-flex align-items-center justify-content-center">
                    <div class="col-4 d-flex flex-column align-items-start justify-content-center">
                        <span>Buscar ação</span>
                        <input class="input-box w-75" type="text" name="" id="">
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center"></div>
                    
                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Natureza</span>
                        <select class="input-box w-75" name="" id="">
                            @foreach($naturezas as $natureza)
                                <option value="{{$natureza->id}}">{{$natureza->descricao}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-2 d-flex flex-column align-items-start justify-content-center">
                        <span>Data</span>
                        <input class="input-box w-75" type="date" name="" id="">
                    </div>
                </div>
            </div>



            <div class="container">
                <div class="row head-table d-flex align-items-center justify-content-start">
                    <div class="col-3 text-center"><span class="spacing-col">Ação</span></div>
                    <div class="col-2 text-center"><span>Data</span></div>
                    <div class="col-2 text-center"><span>Atividade</span></div>
                    <div class="col-2 text-center"><span>Natureza</span></div>
                    <div class="col-2 text-center"><span></span></div>
                </div>
            </div>

            <div class="list container overflow-scroll">
                @foreach($atividades as $atividade)
                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div class="col-3 titulo-span text-center"><span class="spacing-col">{{$atividade->acao->titulo}}</span></div>
                    <div class="col-2 text-center"><span>{{$atividade->data_inicio.' - '.$atividade->data_fim}}</span></div>
                    <div class="col-2 text-center titulo-span"><span>{{$atividade->descricao}}</span></div>
                    <div class="col-2 text-center"><span>{{$atividade->acao->tipo_natureza->descricao}}</span></div>
                    <div class="col-2 d-flex align-items-center justify-content-evenly">
                        <span><a href="#"><img src="/images/acoes/listView/ficha.svg" alt="Visualizar"></a></span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
@endsection
