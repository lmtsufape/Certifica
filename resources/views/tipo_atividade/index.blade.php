@extends('layouts.app')

@section('title')
    Tipos de atividade
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">
        <div class="container">

            <div class="text-center mb-3">
                <h3>Tipos de atividade</h3>
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
                    <a class="criar-acao-button" href="{{ Route('tipoatividade.create') }}">
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Adicionar Tipo de
                        Atividade
                    </a>
                </div>
            </div>


            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-9"><span class="spacing-col">Nome atividade</span></div>
                <div class="col-3"><span class="spacing-col">Funcionalidades</span></div>
            </div>
        </div>
        </div>

        <div class="list container">
            
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-9">
                        <span class="spacing-col">
                            aaaa
                        </span>
                    </div>

                    <div class="col-3 d-flex ">

                        <div class="col-7 d-flex align-items-center justify-content-evenly">
                            <span>
                                <a href="{{Route('tipoatividade.edit')}}">
                                    <img src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar">
                                </a>
                            </span>
                            <span>
                                <a href="{{Route('tipoatividade.delete')}}">
                                    <img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir" title="Excluir">
                                </a>
                            </span>
                        </div>

                    </div>
                </div>
            
        </div>
    </section>
@endsection
