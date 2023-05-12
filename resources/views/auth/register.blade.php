@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h1 class="text-center">Cadastro</h1>

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
                <span class="tittle-input ">Senha</span>
                <input class="w-75 input-text @error('password') is-invalid @enderror" type="password" name="password"
                    id="" required>
            </div>
            <div class="col-md-5 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Confirmar Senha</span>
                <input class="w-75 input-text " type="password" name="password_confirmation" id="" required>
            </div>
        </div>


        <div class="row d-flex aligm-items-start justify-content-start">
            <div class="col-md-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">E-mail</span>
                <input class="w-75 input-text @error('email') is-invalid @enderror" type="email" name="email"
                    id="" required>
            </div>
        </div>


        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href={{ route('home') }}>Voltar</a>
                <button class="submit" type="submit">Cadastrar-se</button>
            </div>
        </div>

    </form>
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
