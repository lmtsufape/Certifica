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
        <h2>Atividade: {{ $atividade->descricao }}</h2>
        <h2>Participantes cadastrados</h2>
    </div>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">CPF</th>
                <th scope="col">Título</th>
                <th scope="col">Carga Horária</th>
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
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('participante.edit', ['participante_id' => $participante->id]) }}">Editar</a>
                        </div>

                        @if(Auth::user()->perfil_id == 2)
                            <div>
                                <a class="dropdown-item" href ="{{ route('participante.delete', ['participante_id' => $participante->id]) }}">Apagar</a>
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
    