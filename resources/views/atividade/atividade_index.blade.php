@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Atividades <a class="btn btn-primary" href="{{ route('atividade.create') }}"
                             role="button">Cadastrar</a> </h2>

    </div>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Status</th>
            <th scope="col">Descrição</th>
            <th scope="col">Informações</th>
            <th scope="col">Inicio</th>
            <th scope="col">Fim</th>
            <th scope="col">Carga Horária</th>
            <th scope="col">Ação ID</th>

        </tr>
        </thead>

        <tbody>
        @foreach($atividades as $atividade)
            <tr>
                <td></td>
                @if($atividade->status == 0)
                    <td> Ativo </td>
                @else
                    <td> Inativo </td>
                @endif
                <td>{{ $atividade->descricao }}</td>
                <td>{{ $atividade->info }}</td>
                <td>{{ $atividade->data_inicio }}</td>
                <td>{{ $atividade->data_fim }}</td>
                <td>{{ $atividade->carga_horaria }}</td>
                <td>{{ $atividade->acao_id }}</td>

                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">Editar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}">Apagar</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
