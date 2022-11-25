@extends('layouts.app')

@section('title')
    Naturezas
@endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Naturezas <a class="btn btn-primary" href="{{ route('natureza.create') }}"
                             role="button">Cadastrar</a> </h2>

    </div>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descrição</th>
            <th scope="col">Tipo Natureza</th>
            <th scope="col">Unidade Administrativa</th>
        </tr>
        </thead>

        <tbody>
        @foreach($naturezas as $natureza)
            <tr>
                <td></td>
                <td>{{ $natureza->descricao }}</td>
                <td>{{ $natureza->tipo_natureza_id }}</td>
                <td>{{ $natureza->unidade_administrativa_id }}</td>
                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('natureza.edit', ['natureza_id' => $natureza->id]) }}">Editar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('natureza.delete', ['natureza_id' => $natureza->id]) }}">Apagar</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
