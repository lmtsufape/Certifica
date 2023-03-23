@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if(session('mensagem'))
                <div class="alert alert-success">
                    {{session('mensagem')}}
                </div>
            @endif
        </div>

        <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Participantes: {{ $atividade->descricao }}</h2>
        </div>
        <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
            <div class='col col-1'>
                <a href="{{ route('participante.create', ['atividade_id' => $atividade->id]) }}"
                   class="btn btn-success">Cadastrar</a>
            </div>
        </div>

        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Título</th>
                    <th scope="col">CH</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
            @foreach($participantes as $participante)
                <tr>
                    <td></td>
                    <td>{{ $participante->nome }}</td>
                    <td>{{ $participante->email }}</td>
                    <td>{{ $participante->cpf }}</td>
                    <td>{{ $participante->titulo }}</td>
                    <td>{{ $participante->carga_horaria }}h</td>

                    <td>
                        <a class="btn btn-secondary"
                           href="{{ route('participante.edit', ['participante_id' => $participante->id]) }}">Editar</a>
                        @if(Auth::user()->perfil_id == 2)
                            <a class="btn btn-danger"
                               href="{{ route('participante.delete', ['participante_id' => $participante->id]) }}">Apagar</a>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
