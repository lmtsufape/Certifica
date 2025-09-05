@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
    <link rel="stylesheet" href="/css/pagination/custom-pagination.css">

    <style>
        a {
            text-decoration: none;
            color: white;
        }

        .btn-danger {
            background-color: #B02A3D
        }
    </style>
@endsection

@section('content')
    <section class="view-list-acoes">
        <div class="container">

            <div class="text-center mb-3">
                <h3>Usuários</h3>
            </div>


            <div class="row d-flex align-items-center justify-content-between">

                <div class="col-1">
                    <a type="button" class="button d-flex align-items-center justify-content-around between"
                        href="{{ route('home') }}">
                        Voltar
                        <img src="/images/acoes/listView/voltar.svg" alt="">
                    </a>
                </div>

                <div class="col-7 d-flex align-items-center justify-content-end">
                    <a class="criar-acao-button" href="{{ route('usuario.create') }}">
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Cadastrar usuário
                    </a>
                </div>
            </div>

            <form action="{{ route('usuario.index')}}" method="GET">
                <div class="mt-2 mb-4 d-flex">
                    <input type="text" class="form-control w-100" placeholder="Buscar usuário..." name="filter[global]" value="{{ request()->query('filter')['global'] ?? '' }}">

                    <button class="btn btn-danger flex-shrink-1 ms-2" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </div>
            </form>




            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-3"><span class="spacing-col">@sortablelink('name', 'Nome')</span></div>
                <div class="col-2"><span>@sortablelink('cpf', 'CPF/ Passaporte')</span></div>
                <div class="col-3"><span>@sortablelink('email', 'E-mail')</span></div>
                <div class="col-2"><span>@sortablelink('perfil_id', 'Tipo')</span></div>
                <div class="col-2"><span>Funcionalidades</span></div>
            </div>
        </div>

        <div class="list container">
            @foreach ($usuarios as $user)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-3">
                        <span class="spacing-col">
                            {{ $user->name }}
                        </span>
                    </div>

                    <div class="col-2">
                        @if ($user->cpf != null)
                            {{ $user->cpf }}
                        @else
                            {{ $user->passaporte }}
                        @endif

                    </div>

                    <div class="col-3 ">
                        <span>
                            {{ $user->email }}
                        </span>

                    </div>

                    <div class="col-2 d-flex ">
                        @if ($user->perfil_id == 1)
                            Administrador
                        @elseif($user->perfil_id == 2)
                            Coordenador
                        @elseif($user->perfil_id == 3)
                            Gestor Institucional
                        @elseif($user->perfil_id == 4)
                            Integrante
                        @elseif($user->perfil_id == 5)
                            Sistema
                        @endif
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="col-6 d-flex align-items-center justify-content-evenly">
                            <span><a href="{{ route('usuario.edit', ['usuario_id' => $user->id]) }}"><img
                                        src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar"></a></span>
                            <span><a href="{{ route('usuario.delete', ['usuario_id' => $user->id]) }}"><img
                                        src="/images/acoes/listView/lixoIcon.svg" alt="Excluir" title="Editar"></a></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 custom-pagination">
            {{ $usuarios->links('pagination::bootstrap-4') }}
        </div>
    </section>
@endsection
