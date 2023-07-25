@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class="container">

        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <section class="section-view pb-3 pt-4">
            <h2 class="titulo-view mb-4">Recuperação de senha</h2>


            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="row d-flex aligm-items-start justify-content-start mb-3">
                    <div class="col-md-10 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">E-mail<span class="ast">*</span></span>
                        <input class="w-75 input-text" name="email" type="text" name="codigo_validacao" required>
                    </div>
                </div>

                <button type="submit" class="">Enviar E-mail</button>
            </form>

        </section>

    </div>
@endsection
