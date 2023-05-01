@extends('layouts.app')

@section('title')
    Editar Participante
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="row">
            @if (session('mensagem'))
                <div class="alert alert-success">
                    {{ session('mensagem') }}
                </div>
            @endif
        </div>
    </div>
    <h1 class="text-center">Editar Participante</h1>

    <form class="container form" action="{{ Route('participante.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">
        <input type="hidden" name="id" value="{{ $participante->id }}">

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Nome</span>
                <input class="w-75 input-text " type="text" name="nome" id="" value="{{$participante->nome}}">
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">CPF</span>
                <input class="w-75 input-text " type="text" name="cpf" id="" placeholder="000.000.000-00" value="{{$participante->cpf}}">
            </div>

        </div>

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Email</span>
                <input class="w-75 input-text " type="email" name="email" id=""
                    placeholder="example@gmail.com" value="{{$participante->email}}">
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Carga Horária</span>
                <input class="w-75 input-text " type="text" name="carga_horaria" id="" value="{{$participante->carga_horaria}}" >
            </div>

        </div>

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Título Atividade</span>
                <input class="w-75 input-text " type="text" name="titulo" id="" value="{{$participante->titulo}}">
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Atividade</span>
                <input class="w-75 input-text " type="email" name="atividade" value="{{ $atividade->descricao }}"
                    disabled>
            </div>

        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel"
                    href={{ Route('participante.index', ['atividade_id' => $atividade->id]) }}> Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>

    </form>
@endsection
