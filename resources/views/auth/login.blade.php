@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/home/homepage.css">
@endsection

@section('content')

    <section class="container d-flex justify-content-center align-items-center home-page-container">

        <section class="box-conteudo d-flex flex-column align-items-start justify-content-start">
            <h1 class="w-100 text-center mb-3">Certifica</h1>

            <div class="text-conteudo-homepage">
                O Certifica é uma plataforma web desenvolvida pela Universidade Federal do 
                Agreste de Pernambuco por meio do Laboratório Multidisciplinar de Tecnologias 
                Sociais em parceria com a Pró-Reitoria de Extensão e Cultura. A ferramenta visa 
                contribuir para ampliar a eficiência da gestão pública no processo de elaboração, 
                gestão e acreditação de certificados emitidos por diversos setores institucionais. 
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
                <p class="text-homepage">Não possui conta? <a class="criar-conta-link" href="{{ route('register') }}">Criar Conta</a></p>
            </div>

        </form>
    </section>
    </html>



@endsection


