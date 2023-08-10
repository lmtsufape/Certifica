@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">
        <h1 class="text-center mb-4">Meus certificados</h1>

        <form action="" id="form" class="container">
            <div>
                <div class="row head-table search-box d-flex align-items-center justify-content-center">
                    <div class="col-4 d-flex flex-column align-items-start justify-content-center">
                        <span>Buscar ação</span>
                        <input class="input-box w-75" type="text" name="buscar_acao" id="buscar_acao">
                    </div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center"></div>

                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Natureza</span>
                        <select class="input-box w-75" name="natureza" id="natureza">
                            <option></option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2 d-flex flex-column align-items-start justify-content-center">
                        <span>Data</span>
                        <input class="input-box w-75" type="date" name="data" id="data">
                    </div>
                </div>
            </div>
        </form>



        <div class="container">
            <div class="row head-table d-flex align-items-center justify-content-start">
                <div class="col-3 text-center"><span class="spacing-col">Ação</span></div>
                <div class="col-2 text-center"><span>Data</span></div>
                <div class="col-2 text-center"><span>Atividade</span></div>
                <div class="col-2 text-center"><span>Natureza</span></div>
                <div class="col-2 text-center"><span>Funcionalidades</span></div>
            </div>
        </div>
        <div class="list container"></div>
    </section>
@endsection




<div class="modal fade" id="modal-info" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header" style="background: #972E3F; color: white;">
                <h5 class="modal-title"><strong>Detalhes da Participação</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h5>Ação</h5>
                    <label><strong>Titulo: </strong><span id='titulo'></span></label>
                    <label><strong>Tipo da Natureza: </strong><span id='tipo-natureza'></span></label>
                    <label><strong>Inicio: </strong><span id='inicio'></span></label>
                    <label><strong>Fim: </strong><span id='fim'></span></label>
                </div>
                <hr>

                <div class="row">
                    <h5>Atividade/Função</h5>
                    <label><strong>Descrição: </strong><span id='descricao'></span></label>
                    <label><strong>Carga Horária: </strong><span id='ch'></span></label>
                    <label><strong>Inicio: </strong><span id='inicio-atividade'></span></label>
                    <label><strong>Fim: </strong><span id='fim-atividade'></span></label>
                </div>
                <hr>

            </div>
        </div>
    </div>
</div>


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
            url: "{{ route('filtro') }}",
            method: "GET",
            data: dados
        }).done(function(data) {
            $(".list").html(data);
        });
    }

    function setaDadosModal($participacao) {
        $('#modal-info').modal('show');

        let inicio = new Date($participacao.atividade.acao.data_inicio).toLocaleDateString('pt-BR');
        let fim = new Date($participacao.atividade.acao.data_fim).toLocaleDateString('pt-BR');

        $('#titulo').text($participacao.atividade.acao.titulo);
        $('#tipo-natureza').text($participacao.atividade.acao.tipo_natureza.descricao);
        $('#inicio').text(inicio);
        $('#fim').text(fim);


        let inicio_part = new Date($participacao.atividade.data_inicio).toLocaleDateString('pt-BR');
        let fim_part = new Date($participacao.atividade.data_fim).toLocaleDateString('pt-BR');

        $('#descricao').text($participacao.atividade.descricao);
        $('#ch').text($participacao.carga_horaria + "H");
        $('#inicio-atividade').text(inicio_part);
        $('#fim-atividade').text(fim_part);


    }
</script>
