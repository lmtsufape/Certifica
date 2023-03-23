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

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Ações</h2>
    </div>
    <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
        <div class='col col-1'>
            <a href="{{route('acao.create')}}" class="btn btn-success">Cadastrar</a>
        </div>
    </div>

    <table class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Data início</th>
            <th scope="col">data fim</th>
            <th scope="col">Status</th>
            <th scope="col">Ação ID</th>
            <th scope="col">Ações</th>
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
                    <a class="btn btn-secondary" href ="{{ route('acao.edit', ['acao_id' => $acao->id]) }}">Editar</a>
                    <a class="btn btn-danger" href ="{{ route('acao.delete', ['acao_id' => $acao->id]) }}">Apagar</a>
                    <a class="btn btn-primary" href ="{{ route('atividade.index', ['acao_id' => $acao->id]) }}">Atividades</a>

                    @if($acao->status == null)
                        <a class="btn btn-success" href ="{{ route('acao.submeter', ['acao_id' => $acao->id]) }}">Submeter</a>
                    @else
                        <a class="btn btn-warning"> Submetida </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
