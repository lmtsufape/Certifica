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
                        <span class="text-center" >Modelo de Certificado</span>
                    </div>
                </a>
                <a class="link-opt" href={{ route('gestor.acoes_submetidas') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/solicitar.svg' }} alt="">
                        <span>Solicitações</span>
                    </div>
                </a>


                <a class="link-opt" href={{ route('tipo_natureza.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src={{ '/images/home/tiposnatureza.svg' }} alt="">
                        <span class="text-center">Tipos Natureza</span>
                    </div>
                </a>

                
                <a class="link-opt" href={{ route('usuario.index') }}>
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt mt-4" src={{ '/images/home/usuarios.svg' }} alt="">
                        <span class="text-center"> Usuários </span>
                    </div>
                </a>

                <a class="link-opt" href="{{route('relatorios.index')}}">
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src="{{ '/images/home/relatorio.svg' }}" alt="">
                        <span class="text-center">Relatórios</span>
                    </div>
                </a>

                <a class="link-opt" href="{{route('tipoatividade.index')}}">
                    <div class="box-opt d-flex flex-column align-items-center justify-content-evenly">
                        <img class="icon-opt" src="{{ '/images/home/tipo_atividade.svg' }}" alt="">
                        <span class="text-center">Tipo de Atividades</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
