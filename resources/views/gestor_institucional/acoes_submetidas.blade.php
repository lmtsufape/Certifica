@extends('layouts.app')

@section('title')
    Ações
@endsection

@section('content')
    <div style="border-block-end: #949494 2px solid; padding-block-end: 5px; margin-block-end: 10px">
        <h2> Ações </h2>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($acaos as $acao)
            <tr>
                <td></td>
                <td>
                    <a href={{ route('gestor.analisar_acao', ['acao_id' => $acao->id]) }}>
                        {{ $acao->titulo }}
                    </a>
                </td>
                <td> {{ $acao->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
