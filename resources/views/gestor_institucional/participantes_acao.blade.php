@extends('layouts.app')

@section('title')
    Integrantes
@endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Atividade: {{ $atividade->descricao }}</h2>
        <h2>Integrantes cadastrados</h2>
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
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
