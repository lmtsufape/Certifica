@extends('layouts.app')

@section('title')
    Atividades
@endsection

@section('content')
    <div class="container">
        @if(session('mensagem'))
            <div class="alert alert-success">
                <p>{{session('mensagem')}}</p>
            </div>
        @endif

        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Atividades: {{ $acao->titulo }}</h2>
        </div>

        <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
            @if($acao->status == null)
                <div class='col col-1'>
                    <a href="{{ route('atividade.create', ['acao_id' => $acao->id]) }}"
                       class="btn btn-success">Cadastrar</a>
                </div>
            @endif
        </div>

        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th scope="col"></th>
                <th scope="col">Descrição</th>
                <th scope="col">Inicio</th>
                <th scope="col">Fim</th>
                <th class="text-center" scope="col">Ações</th>
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
                        @if($acao->status == null)
                            <a class="btn btn-secondary"
                               href="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">Editar</a>
                            <a class="btn btn-danger"
                               href="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}">Apagar</a>
                        @endif
                        <a class="btn btn-primary"
                           href="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}">Participantes</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
