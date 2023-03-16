@extends('layouts.app')

@section('title')
    Ações
@endsection

@section('content')
    <div style="border-block-end: #949494 2px solid; padding-block-end: 5px; margin-block-end: 10px">
        <h2>Ação</h2>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Data início</th>
            <th scope="col">data fim</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td> {{ $acao->titulo }} </td>
                <td> {{ $acao->data_inicio }} </td>
                <td> {{ $acao->data_fim }} </td>
                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('acao.edit', ['acao_id' => $acao->id]) }}">Editar</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="border-block-end: #949494 2px solid; padding-block-end: 5px; margin-block-end: 10px">
        <h2>Atividades {{ $acao->titulo }}</h2>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descrição</th>
            <th scope="col">Inicio</th>
            <th scope="col">Fim</th>

        </tr>
        </thead>

        <tbody>
        @foreach($atividades as $atividade)
            <tr>
                <td></td>
                <td>{{ $atividade->descricao }}</td>
                <td>{{ $atividade->data_inicio }}</td>
                <td>{{ $atividade->data_fim }}</td>

                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">Editar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}">Participantes</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <form method="POST" id="formAnaliseAcao" name="formAnaliseAcao" action="{{ route('gestor.acao_update') }}">
        @csrf

        <input type="hidden" name="id" value="{{ $acao->id }}">

        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>

                <div class="col-md-2">
                    <button name="action" type="submit" class="btn btn-danger" value="negar">Devolver</button>
                </div>

                <div class="col-md-2">
                    <button name="action" type="submit" class="btn btn-success" value="aprovar">Aprovar</button>
                </div>

                <div class="col-md-4"></div>

            </div>
        </div>
    </form>
@endsection
