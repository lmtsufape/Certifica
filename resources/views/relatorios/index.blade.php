@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <h1 class="text-center mb-4">Relatório</h1>
            
            <div class="total"></div>

            <form action="" id="form">
                <div class="container">              
                    <div class="row head-table search-box d-flex align-items-center justify-content-center">
                        <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                            <span>Natureza</span>
                            <select class="input-box w-75" name="natureza" id="natureza">
                                <option></option>
                                @foreach($naturezas as $natureza)
                                    <option value="{{$natureza->id}}">{{$natureza->descricao}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                            <span>Tipo Natureza</span>
                            <select class="input-box w-75" name="tipo_natureza" id="tipo_natureza">
                                <option></option>
                                @foreach($tipos_natureza as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                            <span>Nome da Ação</span>
                            <input class="input-box w-75" type="text" name="buscar_acao" id="buscar_acao">
                        </div>

                        <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                            <span>Nome da Atividade</span>
                            <input class="input-box w-75" type="text" name="atividade" id="atividade">
                        </div>

                        
                    </div>
                </div>
            </form>



            <div class="container">
                <div class="row head-table d-flex align-items-center justify-content-start">
                    <div class="col-3 text-center"><span class="spacing-col">Natureza</span></div>
                    <div class="col-2 text-center"><span>Tipo da Natureza</span></div>
                    <div class="col-2 text-center"><span>Ação</span></div>
                    <div class="col-2 text-center"><span>Atividade</span></div>
                    <div class="col-2 text-center"><span>Certificado</span></div>
                </div>
            </div>
            <div class="list container overflow-scroll"></div>
        </section>

    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
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

    function filtro () {
        var dados = $('#form').serialize();
        
        $.ajax({
            url:    "{{route('relatorios.filtro')}}",
            method: "GET",
            data :  dados
        }).done(function(data){
            console.log(data);
            $(".list").html(data);
        });
    }

</script>