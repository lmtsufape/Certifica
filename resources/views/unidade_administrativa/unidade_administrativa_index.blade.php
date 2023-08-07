@extends('layouts.app')

@section('title')
    Unidades Administrativas
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">
        <div class="container">

            <div class="text-center mb-3">
                <h3>Unidades Administrativas</h3>
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
                    <a class="criar-acao-button" href="{{ route('unidade_administrativa.create') }}">
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Adicionar Unidade
                        Administrativa
                    </a>
                </div>
            </div>
            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-9"><span class="spacing-col">Descrição</span></div>
                <div class="col-3"><span>Funcionalidades</span></div>
            </div>
        </div>

        <div class="list container">
            @foreach ($unidade_administrativas as $unidade_administrativa)
                <div class="row titulo-span linha-table d-flex align-items-center justify-content-center">
                    <div class="col-9">
                        <span class="spacing-col">
                            {{ $unidade_administrativa->descricao }}
                        </span>
                    </div>

                    <div class="col-3 d-flex ">

                        <div class="col-6 d-flex align-items-center justify-content-evenly">
                            <span>
                                <a
                                    href="{{ route('unidade_administrativa.edit', ['unidade_administrativa_id' => $unidade_administrativa->id]) }}">
                                    <img src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar">
                                </a>
                            </span>
                            <span>
                                <a
                                    href="{{ route('unidade_administrativa.delete', ['unidade_administrativa_id' => $unidade_administrativa->id]) }}">
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
