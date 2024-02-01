@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">

        <h1 class="text-center mb-4">Relatório Ação institucional: {{ $acao->titulo }}</h1>

        <div class="text-center mb-3">
            <h3>Atividades / funções</h3>
        </div>

        <form action="" id="form" class="container">
        @csrf
        <div>
        <div class="col-1">
            <a type="button" class="button d-flex align-items-center justify-content-around between"
               href="{{ route('relatorios.index') }}">
                Voltar
                <img src="/images/acoes/listView/voltar.svg" alt="">
            </a>
        </div>
            <div class="row head-table search-box d-flex align-items-center justify-content-center">
                <div class="col-4 d-flex flex-column align-items-start justify-content-center">
                    <span>Tipo de atividade/função</span>
                    <select class="input-box w-75"  name="descricao" id="descricao">
                        <option value="" selected hidden>Escolher...</option>
                        @foreach ($descricoes as $descricao)
                            <option value="{{ $descricao }}">{{ $descricao }}</option>
                        @endforeach
                        @foreach ($tipoAtividade as $tipo)
                            <option value="{{$tipo->name}}">{{$tipo->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                    <span>Entre a data</span>
                    <div class="col-xl-4 campo spacing-row1 input-create-box">
                        <input class="input-box w-200" type="date" name="data" id="data">
                    </div>
                </div>

                <div class="col-4 d-flex flex-column align-items-start justify-content-center">
                    <span>Nome do participante</span>
                    <input class="input-box w-75" type="text" name="buscar_participante" id="buscar_participante">
                </div>


            </div>
        </div>
        </form>
        </div>


        <div class="container">
            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-3  text-center"><span class="spacing-col">Atividade / Função</span></div>
                <div class="col-3  "><span>Período</span></div>
                <div class="col-4 "><span>Integrantes</span></div>
                <div class="col-2 text-center"><span>Total de Certificados</span></div>

            </div>
        </div>

        <div class="list container">
            @foreach($atividades as $atividade)

                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div class="col-3 text-center titulo-span" title="{{$atividade->descricao}}"><span>{{$atividade->descricao}}</span></div>
                    <div class="col-3">
                        <span>{{ collect(explode('-', $atividade->data_inicio))->reverse()->join('/') .
                            ' - ' .
                            collect(explode('-', $atividade->data_fim))->reverse()->join('/') }}</span>
                    </div>
                    <div class="col-4 titulo-span" title="{{ $atividade->lista_nomes }}">
                        {{ $atividade->nome_participantes }}
                    </div>
                    <div class="col-2 text-center"><span>{{$atividade->total}}</span></div>

                </div>
            @endforeach
        </div>
    </section>
@endsection


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>


<script>
    $(document).ready(function() {
        filtro();
    });

    $(document).bind('keyup', '.form', function(e) {
        e.preventDefault();
        filtro();

    });

    $(document).bind('change', '.form', function(e) {
        e.preventDefault();
        filtro();

    });

    function filtro() {
        var dados = $('#form').serialize();
        console.log(dados)
        $.ajax({
            url: "{{ route('relatorios.atividades_filtro', ['acao_id'=>$acao->id]) }}",
            method: "GET",
            data: dados
        }).done(function(data) {
            console.log(data)
            $(".list").html(data);
        });
    }
</script>


