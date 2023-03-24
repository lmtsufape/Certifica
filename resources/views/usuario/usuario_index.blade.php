@extends('layouts.app')

@section('title')
    Usuários
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Usuários</h2>
        </div>
        <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
            <div class='col col-1'>
                <a href="{{route('usuario.create')}}" class="btn btn-success">Cadastrar</a>
            </div>
        </div>

        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Perfil</th>
                    <th scope="col"></th>
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
                        <a class="btn btn-secondary" href ="{{ route('usuario.edit', ['usuario_id' => $usuario->id]) }}">Editar</a>

                        <a class="btn btn-danger" href ="{{ route('usuario.delete', ['usuario_id' => $usuario->id]) }}">Apagar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
