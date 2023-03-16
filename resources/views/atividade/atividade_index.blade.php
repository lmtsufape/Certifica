@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('content')
<div class="container">
    @if(session('mensagem'))
        <div class="alert alert-success">
            <p>{{session('mensagem')}}</p>
        </div>
    @endif
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Ação: {{ $acao->titulo }}</h2>
        <h3>Atividades cadastradas</h3>
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
                            <a class="dropdown-item" href ="{{ route('atividade.delete', ['atividade_id' => $atividade->id]) }}">Apagar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('participante.create', ['atividade_id' => $atividade->id]) }}">Novo Participante</a>
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
</div>
@endsection
    