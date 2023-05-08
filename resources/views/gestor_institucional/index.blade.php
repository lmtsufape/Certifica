@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/coordenador/index.css">
@endsection

@section('content')
    <div class="index-coordenador-view">
        <div class="row d-flex align-items-start justify-content-between">
            <div class="box-coordenador-index d-flex flex-row align-items-start col">
                <a class="link-opt" href={{ route('acao.index') }}>
                    <div class="box-opt padding-listar d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/lista.svg' }} alt="">
                        <span>Listar Ações</span>
                    </div>
                </a>
                <a class="link-opt" href={{ route('acao.create') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/cadastrar.svg' }} alt="">
                        <span>Cadastrar Ações</span>
                    </div>
                </a>
                <a class="link-opt" href={{ route('certificado_modelo.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/certificado.svg' }} alt="">
                        <span>Certificado</span>
                    </div>
                </a>
                <a class="link-opt" href={{ route('gestor.acoes_submetidas') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt"  alt="">
                        <span>Solicitações</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
