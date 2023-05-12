@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/home/homepage.css">
@endsection

@section('content')

    <section class="container d-flex justify-content-center align-items-center home-page-container">

        <section class="box-conteudo d-flex flex-column align-items-start justify-content-start">
            <h1 class="w-100 text-center mb-3">Certifica</h1>

            <div class="Text-conteudo-homepage mb-3">
                O Certifica teve sua primeira versão desenvolvida pela Unidade Acadêmica de
                Garanhuns da Universidade Federal Rural de Pernambuco, sendo posteriormente
                continuada e mantida pela Universidade Federal do Agreste de Pernambuco –
                UFAPE para atender demandas do setor da Escolaridade (atual DRCA).
            </div>

        </section>

        <form class="form-homepage" method="POST" action="{{route('login') }}">
            @csrf
            <h4 class="text-center mb-5">Entrar</h4>

            <input
                class="input-home-form"
                type="email"
                name="email"
                placeholder="Insira seu e-mail"
                autofocus
            id="">

            <input
                class="input-home-form"
                type="password"
                name="password"
                placeholder="Digite sua senha"
                autofocus
            id="">

            <div>
                <button class="button-homepage" type="submit">Entrar</button>
            </div>

            <div class="container-text-homeform">
                <a class="esqueceu-senha-link" href="{{ route('password.request') }}">
                    <p class="text-end text-homepage mt-2">Esqueceu sua senha?</p>
                </a>
            </div>

            <div class="container-text-homeform">
                <p class="text-homepage">Não possui conta? <a class="criar-conta-link" href="{{ route('usuario.registrar') }}">Criar Conta</a></p>
            </div>

        </form>
    </section>
    </html>



@endsection


