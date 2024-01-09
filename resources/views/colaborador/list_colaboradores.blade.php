@extends('layouts.app')

@section('title')
    Colaboradores da Ação {{ $acao->titulo }}
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <h1 class="text-center mb-4">Colaboradores da Ação: {{ $acao->titulo }}</h1>
    <div class="row d-flex align-items-center justify-content-between">

        <div class="col-1">
            <a type="button" class="button d-flex align-items-center justify-content-around between"
                href="{{ route('acao.index') }}">
                Voltar
                <img src="/images/acoes/listView/voltar.svg" alt="">
            </a>
        </div>
        <div class="col-9 text-end">
            <button class="btn criar-acao-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Vincular Colaborador</button>
        </div>

    </div>

    <div class="row head-table d-flex align-items-center justify-content-center">
        <div class="col-3"><span>Nome</span></div>
        <div class="col-3"><span>CPF/ Passaporte</span></div>
        <div class="col-3"><span>Email</span></div>
        <div class="col-2"><span>Funcionalidades</span></div>
    </div>
</div>

<div class="list container">
    @foreach ($colaboradores as $colaborador)
        <div class="row linha-table d-flex align-items-center justify-content-center">
            <div class="col-3">
                <span>
                    {{ $colaborador->user->name }}
                </span>
            </div>

            <div class="col-3">
                @if ($colaborador->user->cpf != null)
                    {{ $colaborador->user->cpf }}
                @else
                    {{ $colaborador->user->passaporte }}
                @endif
            </div>

            <div class="col-3">
                {{ $colaborador->user->email }}
            </div>

            <div class="col-2">
                <a href="{{ route('acao.remover_colaborador', ['acao' => $acao->id, 'colaborador' => $colaborador->id]) }}">
                    <img src="/images/acoes/listView/lixoIcon.svg" alt="Remover" title="Remover Colaborador"></img>
                </a>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informe o seu CPF ou Passaporte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="container form"
                action="{{ Route('colaborador.create', ['acao_id' => $acao->id]) }}" method="GET">
                <div style="padding:10px 0 20px 90px;" class="modal-body row justify-content-center">

                    <!--checkbox para escolher passaporte e cpf -->
                    <div class="row d-flex aligm-items-start justify-content-center">
                        <div class="col-10 d-flex align-items-center justify-content-evenly">
                            <div style="margin:0 5px 0 -3px;" class="col-2">
                                <input type="radio" name="cpf_pass" id="cpf_pass" value="cpf" checked> CPF
                            </div>

                            <div class="col-10">
                                <input type="radio" name="cpf_pass" id="cpf_pass" value="passaporte"> Passaporte
                            </div>
                        </div>
                    </div>

                    <div id="cpf_dinamico" class="col-10 camporegister_dinamico_show">
                        <label>CPF:</label>
                        <input class="w-75 form-control" type="text" name="cpf" id="cpf"
                            placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                            title="Digite um CPF válido (000.000.000-00)" required>
                    </div>

                    <div id="passaporte_dinamico" class="col-10 camporegister_dinamico_hide">
                        <label>Passaporte:</label>
                        <input class="w-75 form-control" type="text" name="passaporte" id="passaporte"
                            placeholder="" title="Digite o passaporte">
                    </div>
                </div>
                <div class="modal-footer row justify-content-center">
                    <div class="col-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn button">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/auth/cpf_passaporte.js"></script>
@endsection
