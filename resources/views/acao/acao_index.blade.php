@extends('layouts.app')

@section('title')
    Ações
@endsection

@section('content')
<div class='container'>
    <div class='row'>
        @if(session('mensagem'))
            <div class='alert alert-success'>
                <p>{{session('mensagem')}}</p>
            </div>
        @endif
    </div>

    <div class='row'>
        @if(session('error_mensage'))
            <div class='alert alert-danger'>
                <p>{{session('error_mensage')}}</p>
            </div>
        @endif
    </div>

    <div class='row'>
        @if($errors->any())
            <div class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
    </div>


    <div style="border-block-end: #949494 2px solid; padding-block-end: 5px; margin-block-end: 10px">
        <h2>Ações <a class="btn btn-primary" href="{{ route('acao.create') }}"
                    role="button">Cadastrar</a> </h2>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Data início</th>
            <th scope="col">data fim</th>
            <th scope="col">Status</th>
            <th scope="col">Ação ID</th>
        </tr>
        </thead>
        <tbody>
        @foreach($acaos as $acao)
            <tr>
                <td></td>
                <td>{{ $acao->titulo }}</td>
                <td>{{ $acao->data_inicio }}</td>
                <td>{{ $acao->data_fim }}</td>
                @if($acao->status == 0)
                    <td> Ativo </td>
                @else
                    <td> Inativo </td>
                @endif
                <td>{{ $acao->id }}</td>
                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('acao.edit', ['acao_id' => $acao->id]) }}">Editar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('acao.delete', ['acao_id' => $acao->id]) }}">Apagar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('atividade.create', ['acao_id' => $acao->id]) }}">Nova Atividade</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('atividade.index', ['acao_id' => $acao->id]) }}">Atividades</a>
                        </div>

                        @if($acao->status == null)
                            <div>
                                <a class="dropdown-item" href ="{{ route('acao.submeter', ['acao_id' => $acao->id]) }}">Submeter</a>
                            </div>
                        @else
                            <div>
                                <a class="dropdown-item"> Submetida </a>
                            </div>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
