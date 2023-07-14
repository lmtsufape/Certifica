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

            </div>
        </div>

    </div>
@endsection
