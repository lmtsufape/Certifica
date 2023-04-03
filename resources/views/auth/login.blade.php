@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/home/homepage.css">
@endsection

@section('content')
    <section class="container d-flex flex-row justify-content-center align-items-center home-page-container">
        <form class="form-homepage" method="POST" action="{{route('login') }}">
            @csrf
            <h4 class="text-center">Login</h4>

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
                    <p class="text-end text-homepage">Esqueceu sua senha ?</p>
                </a>
            </div>
            <div class="container-text-homeform">
                <p class="text-homepage">Não possui conta? <a class="criar-conta-link" href="{{ route('register') }}">Criar Conta</a></p>
            </div>
        </form>
    </section>
    </html>
@endsection


