@extends('layouts.app')

@section('title')
    Cadastrar Participantes
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h2 class="text-center mb-4">Cadastrar Usuario</h2>
    <form class="container form" action="{{ Route('usuario.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Nome completo</span>
                <input class="w-75 input-text " type="text" name="name" id="nome" minlength="10" required>
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">CPF</span>
                <input class="w-75 input-text " type="text" name="cpf" id="cpf" placeholder="000.000.000-00"
                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido (000.000.000-00)" required>
            </div>

        </div>

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">E-mail</span>
                <input class="w-75 input-text" type="email" name="email" id="" placeholder="example@gmail.com">
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Senha</span>
                <input class="w-75 input-text" type="password" name="password" id="">
            </div>

        </div>


        <div class="row d-flex aligm-items-start justify-content-start">
            <div class="col-7 spacing-row1 input-create-box align-items-start justify-content-start flex-column">
                <span class="tittle-input">Tipo de usuário</span>

                <select class="w-100 input-text" name="perfil_id" id="select_perfil" required>
                    <option value="" selected hidden>Escolher...</option>
                    @foreach ($perfils as $perfil)
                        <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column" id="unidade_administrativa">
                <span class="tittle-input ">Unidade Administrativa</span>

                <select class="w-100 input-text" name="unidade_administrativa_id" id="unidade_administrativa" required>
                    <option selected hidden>Escolher...</option>
                    @foreach ($unidade_administrativas as $unidade_administrativa)
                        <option value="{{ $unidade_administrativa->id }}">{{ $unidade_administrativa->descricao }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href=""> Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>

    
    <script>
        $("#unidade_administrativa").hide();
        $(document).ready(function ()
        {
            $("#select_perfil").change(function ()
            {
                if($("#select_perfil").val() == 2)
                {
                    $("#unidade_administrativa").hide();
                } else if($("#select_perfil").val() == 3)
                {
                    $("#unidade_administrativa").show();
                    $("#usuario_cpf").hide();
                } else
                {
                    $("#unidade_administrativa").hide();
                }
            });
        });
    </script>

@endsection
