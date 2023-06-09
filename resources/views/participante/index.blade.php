@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/coordenador/index.css">
@endsection

@section('content')

    <div class="index-coordenador-view">
        <div class="row d-flex align-items-start justify-content-between">
            <div class="box-coordenador-index d-flex flex-row align-items-start col">   
                <a class="link-opt" href="{{ route('participante.certificados') }}">
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src="{{ '/images/home/certificado.svg' }}" alt="">
                        <span>Meus Certificados</span>
                    </div>
                </a>
                
            </div>

        </div>
    </div>


@endsection