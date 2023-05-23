@extends('layouts.app')

@section('title')
    Editar Participante
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h1 class="text-center mb-4">Atividade: {{ $atividade->descricao }}</h1>
    <h2 class="text-center mb-4">Editar Participante</h2>

    <form class="container form" action="{{ Route('participante.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">
        <input type="hidden" name="id" value="{{ $participante->id }}">

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Nome</span>
                <input class="w-75 input-text " type="text" name="nome" id=""
                    value="{{ $participante->user->name }}" disabled>
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">CPF</span>
                <input class="w-75 input-text " type="text" name="cpf" id="" placeholder="000.000.000-00"
                    value="{{ $participante->user->cpf }}" disabled>
            </div>

        </div>

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">E-mail</span>
                <input class="w-75 input-text " type="email" name="email" id="" placeholder="example@gmail.com"
                    value="{{ $participante->user->email }}" disabled>
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Carga Horária Total</span>
                <input class="w-75 input-text " type="text" name="carga_horaria" id=""
                    value="{{ $participante->carga_horaria }}" pattern="[0-9]+" title="Digite um número válido" required>
            </div>

        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel"
                    href={{ Route('participante.index', ['atividade_id' => $atividade->id]) }}> Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>

        <div class="alert alert-warning text-center mb-0 mt-2" role="alert"><strong>Atenção:</strong>
            <small style="color: red">É necessário editar o perfil do usuário vinculado a este CPF para alterar as
                informações de Nome, Email e CPF.</small>
        </div>

    </form>
    
@endsection
