@extends('layouts.app')

@section('title')
    Ações
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Ação</h2>
        </div>

        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th scope="col"></th>
                <th scope="col">Título</th>
                <th scope="col">Início</th>
                <th scope="col">Fim</th>
                <th scope="col">Anexo</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td> {{ $acao->titulo }} </td>
                    <td> {{ $acao->data_inicio }} </td>
                    <td> {{ $acao->data_fim }} </td>
                    <td> <a href="{{ route('anexo.download', ['acao_id' => $acao->id])}}">Anexo</a> </td>
                    <td>
                        <a class="btn btn-secondary" href ="{{ route('acao.edit', ['acao_id' => $acao->id]) }}">Editar</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Atividades: {{ $acao->titulo }}</h2>
        </div>

        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th scope="col"></th>
                <th scope="col">Descrição</th>
                <th scope="col">Inicio</th>
                <th scope="col">Fim</th>
                <th scope="col"></th>

            </tr>
            </thead>

            <tbody>
            @foreach($atividades as $atividade)
                <tr>
                    <td></td>
                    <td>{{ $atividade->descricao }}</td>
                    <td>{{ $atividade->data_inicio }}</td>
                    <td>{{ $atividade->data_fim }}</td>
                    <td class="text-center">
                        <a class="btn btn-secondary" href ="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">Editar</a>

                        <a class="btn btn-primary" href ="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}">Participantes</a>
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
                        <button name="action" type="submit" class="btn btn-danger" value="reprovar">Reprovar</button>
                    </div>

                    <div class="col-md-2">
                        <button name="action" type="submit" class="btn btn-success" value="aprovar">Aprovar</button>
                    </div>

                    <div class="col-md-4"></div>

                </div>
            </div>
        </form>
    </div>
@endsection
