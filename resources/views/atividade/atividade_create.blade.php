@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/cadastros/cadastrarAtividade.css">
@endsection

@php
    $tituloModal = 'Cadastrar Atividade';
@endphp

<x-modal-component :title="$tituloModal">
    <form id="atividadeForm" action="{{ route('atividade.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="acao_id" value="{{ $acao->id }}">
        <input type="text" class="form-control" name="titulo" value="{{ $acao->titulo }}" hidden>

        <div class="mb-3">
            <label for="descricao" class="form-label">Atividade / Função</label>
            <select class="form-select" name="descricao" id="select_atividade">
                <option value="" selected hidden>Escolher...</option>
                @foreach ($tipos_ordenados as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="date" class="form-control" name="data_inicio">
            </div>
            <div class="col">
                <label for="data_fim" class="form-label">Data de Término</label>
                <input type="date" class="form-control" name="data_fim">
            </div>
        </div>
    </form>
</x-modal-component>

<!-- Botão para abrir o modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalComponent">
    Cadastrar Atividade
</button>