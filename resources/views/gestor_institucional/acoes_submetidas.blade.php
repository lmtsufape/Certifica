@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">
        <h1 class="text-center mb-4">Solicitações</h1>





        <div class="container">


            <div class="row d-flex align-items-center justify-content-start">
                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                        href="{{ route('home') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

            </div>

            <div class="row head-table d-flex align-items-center justify-content-start">
                <div class="col-3 text-center"><span class="spacing-col">Título</span></div>
                <div class="col-4 text-center"><span>Status</span></div>
                <div class="col-2 text-center"><span>Data de Submissão</span></div>
                <div class="col-3 text-center"><span>Funcionalidades</span></div>
            </div>
        </div>

        <div class="list container"></div>
    </section>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function() {
        carregar_lista();
    });

    function carregar_lista() {
        $.ajax({
            url: "{{ route('acoes_submetidas_list') }}",
            method: "GET",
        }).done(function(data) {
            $(".list").html(data);
        });
    }
</script>
