@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Participantes <a class="btn btn-primary" href="{{ route('participante.create') }}"
            role="button">Cadastrar</a> </h2>

    </div>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">CPF</th>
            <th scope="col">Ativo</th>
            <th scope="col">Atividade ID</th>
        </tr>
        </thead>

        <tbody>
        @foreach($participantes as $participante)
            <tr>
                <td></td>
                <td>{{ $participante->nome }}</td>
                <td>{{ $participante->email }}</td>
                <td>{{ $participante->cpf }}</td>
                @if($participante->ativo == 0)
                    <td> Ativo </td>
                @else
                    <td> Inativo </td>
                @endif
                <td>{{ $participante->atividade_id }}</td>

                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('participante.edit', ['participante_id' => $participante->id]) }}">Editar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('participante.delete', ['participante_id' => $participante->id]) }}">Apagar</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
