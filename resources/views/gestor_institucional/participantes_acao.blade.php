@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('content')
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
            <th scope="col">Status</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
