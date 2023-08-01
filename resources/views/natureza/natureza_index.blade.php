@extends('layouts.app')

@section('title')
    Naturezas
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <div class="container ">

                <div class="text-center mb-3">
                    <h3>Tipos de Natureza</h3>
                </div>

                <div class="row d-flex align-items-center justify-content-end">
                    <a class="criar-acao-button" href="{{route('natureza.create')}}">
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Adicionar
                    </a>
                </div>
                <div class="row head-table d-flex align-items-center justify-content-center">
                    <div class="col-9"><span class="spacing-col">Descrição</span></div>
                    <div class="col-3"><span>Funcionalidades</span></div>
                </div>
            </div>

            <div class="list container">

                @foreach ($naturezas as $natureza)
                    <div class="row linha-table d-flex align-items-center justify-content-center">
                        <div class="col-9">
                            <span class="spacing-col">
                                {{ $natureza->descricao }}
                            </span>
                        </div>

                        <div class="col-3 d-flex ">

                            <div class="col-6 d-flex align-items-center justify-content-evenly">
                                <span>
                                    <a
                                        href="{{ route('natureza.edit', ['natureza_id' => $natureza->id]) }}">
                                        <img src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar">
                                    </a>
                                </span>
                                <span>
                                    <a
                                        href="{{ route('natureza.delete', ['natureza_id' => $natureza->id]) }}">
                                        <img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir" title="Excluir">
                                    </a>
                                </span>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endsection
