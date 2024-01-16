@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/coordenador/index.css">
@endsection

@section('content')
    <div class="index-view">

        <div class="container-fluid">
            <div class="box-index">

                <a class="link-opt" href="{{ route('participante.certificados') }}">
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src="{{ '/images/home/certificado.svg' }}" alt="">
                        <span class="text-center">Meus Certificados</span>
                    </div>
                </a>

                @auth
                    @if(auth()->user()->colaboracoes->isNotEmpty())
                        <a class="link-opt" href="{{ route('listar.colaboracoes') }}">
                            <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                                <img class="icon-opt" src="{{ '/images/home/lista.svg' }}" alt="">
                                <span class="text-center">Listar Colaborações</span>
                            </div>
                        </a>
                    @endif
                @endauth
            </div>
        </div>

    </div>
@endsection
