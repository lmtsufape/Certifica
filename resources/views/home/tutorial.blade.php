@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
@endsection

@section('content')
    <div class="container section-view">
        <div class="card">
            <div class="row justify-content-center">

                <h1 class="titulo-card mb-4 mt-4">Tutorial de uso</h1>


                <p>
                    Clique <a target="_blank"
                        href="https://drive.google.com/drive/folders/1_gicfPwYkoKjYB5dJBlRfLunuRUZdBJE?usp=sharing">aqui</a>
                    para obter o manual em pdf
                </p>
                @include('home.guiaView')
                <p>
                    Clique <a style="color:#B02A3D" target="_blank"
                        href="https://drive.google.com/drive/folders/1_gicfPwYkoKjYB5dJBlRfLunuRUZdBJE?usp=sharing">aqui</a>
                    para obter o manual em pdf
                </p>

            </div>
        </div>
    </div>
@endsection
