@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <section class="view-list-acoes">

        <div class="container">

            <h1 class="text-center mb-4">Modelos de certificados</h1>


            <div class="row d-flex align-items-center justify-content-between">

                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                        href="{{ route('home') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-end">

                    @if (Auth::user()->perfil_id == 1)
                        <div class="row d-flex align-items-center justify-content-end">
                            <a class="criar-acao-button" href="{{ route('certificado_modelo.create') }}">
                                <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Cadastrar Modelo
                            </a>
                        </div>
                    @elseif(Auth::user()->perfil_id == 3)
                        <div class="row d-flex align-items-center justify-content-end">
                            <a class="criar-acao-button" href="{{ route('tipo_certificado_modelo.create') }}">
                                <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Cadastrar Modelo
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-4"><span class="spacing-col">Descrição</span></div>
                <div class="col-4"><span>Únidade Administrativa</span></div>
                <div class="col-4"><span>Funcionalidades</span></div>
            </div>
        </div>


        <div class="list container">
            @foreach ($certificado_modelos as $modelo)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-4"><span class="spacing-col">{{ $modelo->descricao }}</span></div>
                    <div class="col-4"><span>
                            @if ($modelo->unidadeAdministrativa)
                                {{ $modelo->unidadeAdministrativa->descricao }}
                            @endif
                        </span></div>
                    <div class="col-4 d-flex align-items-center justify-content-around">



                        <span class="col-3 d-flex align-items-center justify-content-around">
                            <a href="{{ route('certificado_modelo.show', ['id' => $modelo->id]) }}">
                                <img src="/images/acoes/listView/eye.svg" alt="Visualizar dados" title="Visualizar">
                            </a>
                            <a href="{{ Route('certificado_modelo.edit', ['id' => $modelo->id]) }}">
                                <img src="/images/acoes/listView/editar.svg" alt="Editar"
                                    title="Editar Modelo de certificado">
                            </a>
                            <a href="{{ route('certificado_modelo.delete', ['id' => $modelo->id]) }}">
                                <img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir" title="Excluir">
                            </a>
                        </span>

                        <span class="col-9 "></span>

                    </div>
                </div>
            @endforeach
        </div>


    </section>
@endsection
