@extends('layouts.app')

@section('title')
    Tipos de natureza
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">
        <div class="container">

            <div class="text-center mb-3">
                <h3>Tipos de natureza</h3>
            </div>

            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                        href="{{ route('home') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

                <div class="col-8 text-end">
                    <a class="criar-acao-button" href="{{ route('tipo_natureza.create') }}">
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Adicionar Tipo de
                        Natureza
                    </a>
                </div>
            </div>


            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-9"><span class="spacing-col">Descrição</span></div>
                <div class="col-3"><span class="spacing-col">Funcionalidades</span></div>
            </div>
        </div>
        </div>

        <div class="list container">
            @foreach ($tipo_naturezas as $natureza)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-9">
                        <span class="spacing-col">
                            {{ $natureza->descricao }}
                        </span>
                    </div>

                    <div class="col-3 d-flex ">

                        <div class="col-7 d-flex align-items-center justify-content-evenly">
                            <span>
                                <a href="{{ route('tipo_natureza.edit', ['id' => $natureza->id]) }}">
                                    <img src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar">
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('tipo_natureza.delete', ['id' => $natureza->id]) }}">
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
