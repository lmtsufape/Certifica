@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <h1 class="text-center mb-4">Solicitações</h1>
            <div class="container">
                <div class="row head-table d-flex align-items-center justify-content-start">
                    <div class="col-4 text-center"><span class="spacing-col">Título</span></div>
                    <div class="col-4 text-center"><span>Status</span></div>
                    <div class="col-4 text-center"><span>Funcionalidades</span></div>
                </div>
            </div>

            <div class="list container overflow-scroll">
                @foreach ($acaos as $acao)
                    <div class="row linha-table d-flex align-items-center justify-content-start">
                        <div class="col-4 text-center">
                            <span class="spacing-col">
                                {{ $acao->titulo }}
                            </span>
                        </div>
                        <div class="col-4 text-center"><span>{{ $acao->status }}</span></div>
                        <div class="col-4 text-center">
                            <a href="{{ route('gestor.analisar_acao', ['acao_id' => $acao->id]) }}">
                                <img src="/images/acoes/listView/eye.svg" alt="Visualizar" title="Visualizar">
                            </a>
    
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endsection
