@extends('layouts.app')

@section('title')
    Usuários
@endsection

@section('content')
    <div style="border-block-end: #949494 2px solid; padding-block-end: 5px; margin-block-end: 10px">
        <h2>Usuários <a class="btn btn-primary" href="{{ route('usuario.create') }}"
                     role="button">Cadastrar</a> </h2>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Perfil</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td></td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                @if($usuario->perfil_id == 1)
                    <td>Administrador</td>
                @elseif($usuario->perfil_id == 2)
                    <td>Coordenador</td>
                @elseif($usuario->perfil_id == 3)
                    <td>Gestor Institucional</td>
                @else
                    <td>Participante</td>
                @endif
                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('usuario.edit', ['usuario_id' => $usuario->id]) }}">Editar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('usuario.delete', ['usuario_id' => $usuario->id]) }}">Apagar</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
