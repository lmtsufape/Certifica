@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h1 class="text-center">Cadastro de Usuário</h1>

    <form class="container form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row d-flex aligm-items-start justify-content-start ">

            <div class="col-md-6 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Nome completo</span>
                <input class="w-75 input-text @error('name') is-invalid @enderror" type="text" name="name"
                    id="" required>
            </div>

            <div class="col-md-5 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">CPF</span>
                <input class="w-75 input-text @error('cpf') is-invalid @enderror" type="text" name="cpf"
                    id="" required>
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-start ">
            <div class="col-md-6 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">E-mail</span>
                <input class="w-75 input-text @error('email') is-invalid @enderror" type="email" name="email"
                       id="" required>
            </div>
            <div class="col-md-5 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Celular</span>
                <input class="w-75 input-text " type="text" name="celular" id="" required>
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-start">
            <div class="col-md-6 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Perfil</span>
                <select class="w-75 input-text" name="perfil_id" id="select_perfil" required>
                    <option selected hidden> -- Perfil -- </option>
                    <option value="2"> Técnico </option>
                </select>
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-start ">
            <div class="col-md-6 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Instituição de Vínculo</span>
                <select class="w-75 input-text" name="instituicao" id="select_instituicao" required>
                    <option selected hidden> -- Instituição -- </option>
                    <option value="2"> Universidade Federal do Agreste de Pernambuco - UFAPE </option>
                </select>
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-start">
            <div class="col-md-6 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">SIAPE</span>
                <input class="w-75 input-text " type="text" name="siape" id="" required>
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-start ">
            <div class="col-md-6 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Senha</span>
                <input class="w-75 input-text @error('password') is-invalid @enderror" type="password" name="password"
                       id="" required>
            </div>
            <div class="col-md-5 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Confirmar Senha</span>
                <input class="w-75 input-text " type="password" name="password_confirmation" id="" required>
            </div>
        </div>

        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href={{ route('home') }}>Voltar</a>
                <button class="submit" type="submit">Cadastrar-se</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function ()
        {
            $("#select_perfil").change(function ()
            {
                if($("#select_perfil").val() == 4)
                {
                    $("#select_unidade_adm").hide();
                    $("#span_unidade_adm").hide();
                } else
                {
                    $("#select_unidade_adm").show();
                    $("#span_unidade_adm").show();
                }
            });
        });
    </script>
@endsection


<!--


@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
   </span>
@enderror

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@error('cpf')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@error('password')
    <span class="invalid-feedback" role="alert">
        strong>{{ $message }}</strong
    </span>
@enderror

-->
