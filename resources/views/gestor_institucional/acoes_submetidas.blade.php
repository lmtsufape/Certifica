@extends('layouts.app')

@section('title')
    Ações
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Ações</h2>
        </div>
        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th class="text-center" scope="col"></th>
                <th class="text-center" scope="col">Título</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($acaos as $acao)
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center">
                        @if($acao->status == "Em análise")
                            <a href={{ route('gestor.analisar_acao', ['acao_id' => $acao->id]) }}>
                                {{ $acao->titulo }}
                            </a>
                        @else()
                            <a>
                                {{ $acao->titulo }}
                            </a>
                        @endif
                    </td>
                    <td class="text-center">
                        <a class="btn btn-warning text-center"> {{ $acao->status }}</a>
                    </td>
                    <td class="text-center"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endsection
