@extends('layouts.app')

@section('title')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="/css/coordenador/index.css">
@endsection

@section('content')
    <div class="index-view">

        <div class="container-fluid">

            <div class="box-index">

                <a class="link-opt" href={{ route('unidade_administrativa.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/uniadministrativa.svg' }} alt="">
                        <span class="text-center">Unidades Administrativas</span>
                    </div>
                </a>

                <a class="link-opt" href={{ route('tipo_natureza.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/tiposnatureza.svg' }} alt="">
                        <span class="text-center">Tipos Natureza</span>
                    </div>
                </a>
                <a class="link-opt" href={{ route('natureza.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/natureza.svg' }} alt="">
                        <span class="text-center">Naturezas</span>
                    </div>
                </a>
                <a class="link-opt" href={{ route('usuario.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt mt-4" src={{ '/images/home/usuarios.svg' }} alt="">
                        <span class="text-center">Usuários</span>
                    </div>
                </a>
                <a class="link-opt" href={{ route('certificado_modelo.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/certificado.svg' }} alt="">
                        <span class="text-center">Certificado</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
