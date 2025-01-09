@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">
        <h1 class="text-center mb-4">Relatório</h1>

        <div class="total">
            <strong class='d-flex justify-content-sm-end mb-5' style='font-size: 20px; margin-right: 20px;'>Total de certificados: {{$total}}</strong>
        </div>



     <form action="" id="form" class="container">
            @csrf
            <div>
                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                       href="{{ route('home') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

               <div class="row head-table search-box d-flex align-items-center justify-content-center">
                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Nome da Ação</span>
                        <input class="input-box w-75" type="text" name="buscar_acao" id="buscar_acao">
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Natureza</span>
                        <select class="input-box w-75" name="natureza" id="natureza">
                            <option></option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Tipo Natureza</span>
                        <select class="input-box w-75" name="tipo_natureza" id="tipo_natureza">
                            <option></option>
                            @foreach ($tipos_natureza as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Ano</span>
                        <select class="input-box w-75" name="ano" id="ano">
                            <option></option>
                            @foreach ($anos as $ano)
                                <option value="{{ $ano }}">{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
            </div>
        </form>



        <div class="container">
            <div class="row head-table d-flex align-items-center justify-content-start">
                <div class="col-2 text-center"><span>Ação</span></div>
                <div class="col-2 text-center"><span class="spacing-col">Natureza</span></div>
                <div class="col-2 text-center"><span>Tipo da Natureza</span></div>
                <div class="col-2 text-center"><span>Atividades</span></div>
                <div class="col-1 text-center"><span>Total de Certificados</span></div>
                <div class="col-1 text-center"><span>Certificados</span></div>
                <div class="col-2 text-center"><span>Emissor</span></div>
            </div>
        </div>

        <div class="list container">
            @foreach($acoes as $acao)
                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div class="col-2 text-center titulo-span" title="{{$acao->titulo}}"><span>{{$acao->titulo}}</span></div>
                    <div class="col-2 titulo-span text-center"><span class="spacing-col">{{$acao->tipo_natureza->natureza->descricao}}</span></div>
                    <div class="col-2 text-center titulo-span" title="{{$acao->tipo_natureza->descricao}}"><span>{{$acao->tipo_natureza->descricao}}</span></div>
                    <div class="col-2 text-center titulo-span" title="{{$acao->nome_atividades}}">
                        <a href="{{route('relatorios.atividades', ['acao_id'=>$acao->id])}}" target="blank" ><img src="/images/atividades/participantes.svg" alt=""></a></div>
                    <div class="col-1 text-center"><span>{{ $acao->total }}</span></div>
                    <div class="col-1 text-center">
            <span> <a href="{{route('certificados.download', ['acao_id'=>$acao->id])}}" target="blank">
                        <img src="/images/acoes/listView/zipcertificados.svg" alt="Visualizar" title="Baixar Certificados">
                    </a>
            </span>
                    </div>
                    <div title="{{ $acao->unidadeAdministrativa->descricao }}" class="col-2 text-center titulo-span"><span>{{ $acao->unidadeAdministrativa->descricao }}</span></div>
                </div>
            @endforeach
        </div>
    </section>
@endsection


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>


<script>
    /* $(document).ready(function() {
        filtro();
    }); */

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

        $.ajax({
            url: "{{ route('relatorios.filtro') }}",
            method: "GET",
            data: dados
        }).done(function(data) {
            $(".list").html(data);
        });
    }
</script>
