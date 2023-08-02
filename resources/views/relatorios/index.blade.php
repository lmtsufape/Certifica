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

        <div class="total"></div>

        <form action="" id="form" class="container">
            <div>
                <a type="button" class="btn btn-sm btn-outline-dark" href="{{ route('home') }}">Voltar</a>
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
        <div class="list container"></div>
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

        $.ajax({
            url: "{{ route('relatorios.filtro') }}",
            method: "GET",
            data: dados
        }).done(function(data) {
            $(".list").html(data);
        });
    }
</script>
