@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <div class="container">

                <div class="text-center mb-3">
                    <h3>Usuários</h3>
                </div>

                <div class="row d-flex align-items-center justify-content-end">
                    <a class="criar-acao-button" href="{{ route('usuario.create') }}">
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Cadastrar usuário
                    </a>
                </div>
                <div class="row head-table d-flex align-items-center justify-content-center">
                    <div class="col-4"><span class="spacing-col">Nome</span></div>
                    <div class="col-4"><span>CPF</span></div>
                    <div class="col-2"><span>Tipo</span></div>
                    <div class="col-2"><span>Funcionalidades</span></div>
                </div>
            </div>

            <div class="list container overflow-scroll">
                @foreach ($usuarios as $user)
                    <div class="row linha-table d-flex align-items-center justify-content-center">
                        <div class="col-4">
                            <span class="spacing-col">
                                {{ $user->name }}
                            </span>
                        </div>

                        <div class="col-4">
                            {{ $user->cpf }}
                        </div>

                        <div class="col-2 d-flex ">
                            @if ($user->perfil_id == 1)
                                Administrador
                            @elseif($user->perfil_id == 2)
                                Coordenador
                            @elseif($user->perfil_id == 3)
                                Gestor Institucional
                            @endif
                        </div>
                        <div class="col-2 d-flex">
                            <div class="col-6 d-flex align-items-center justify-content-evenly">
                                <span><a href="{{route('usuario.edit', ['usuario_id' => $user->id])}}"><img src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar"></a></span>
                                <span><a href="{{route('usuario.delete', ['usuario_id' => $user->id])}}"><img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir" title="Editar"></a></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endsection
