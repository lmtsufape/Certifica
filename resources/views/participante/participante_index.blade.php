@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if (session('mensagem'))
                <div class="alert alert-success">
                    {{ session('mensagem') }}
                </div>
            @endif
        </div>
    </div>

    <section class="view-list-acoes">
        <div class="container">
      
            <div class="text-center mb-4">
                <h2>{{ $acao->titulo }}</h2>
            </div>

            <div class="text-center mb-3">
                <h3>Participante</h3>
            </div>

            <div class="row d-flex align-items-center justify-content-end">
                @if ($acao->status == null)
                    <a class="criar-acao-button"
                        href="{{ route('participante.create', ['atividade_id' => $atividade->id]) }}">
                        <img src="/images/acoes/listView/criar.svg" alt=""> Adicionar Participante
                    </a>
                @endif
            </div>

            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-4"><span class="spacing-col">Nome</span></div>
                <div class="col-4"><span>CPF</span></div>
                <div class="col-4"><span>Função</span></div>
            </div>
        </div>

        <div class="list container overflow-scroll">
            @foreach ($participantes as $participante)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-4">
                        <span class="spacing-col">
                            {{ $participante->nome }}
                        </span>
                    </div>
                    <div class="col-4">
                        {{ $participante->cpf }}
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-start">
                        <div class="col-2 d-flex align-items-center justify-content-center pr-2">
                            {{ $atividade->descricao }}
                        </div>
                        <div class="col-5">

                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-evenly">

                            @if ($acao->status == 'Aprovada')
                                <a
                                    href="{{ route('participante.ver_certificado', ['participante_id' => $participante->id]) }}" target="_blank">
                                    ver certificado
                                </a>
                            @endif

                            @if (Auth::user()->perfil_id == 2)
                                <a href="{{ route('participante.delete', ['participante_id' => $participante->id]) }}">
                                    <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                                </a>
                            @endif

                            @if ($acao->status == null)
                                <a href="{{ route('participante.edit', ['participante_id' => $participante->id]) }}">
                                    <img src="/images/acoes/listView/editar.svg" alt="">
                                </a>
                            @endif
                            
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
