@extends('layouts.app')

@section('title')
    Unidades Administrativas
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Unidades Administrativas</h2>
        </div>
        <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
            <div class='col col-1'>
                <a href="{{route('unidade_administrativa.create')}}" class="btn btn-success">Cadastrar</a>
            </div>
        </div>

        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th scope="col"></th>
                <th scope="col">Descrição</th>
                <th scope="col"></th>
            </tr>
            </thead>

            <tbody>
            @foreach($unidade_administrativas as $unidade_administrativa)
                <tr>
                    <td></td>
                    <td>{{ $unidade_administrativa->descricao }}</td>

                    <td>
                        <a class="btn btn-secondary"
                           href="{{ route('unidade_administrativa.edit', ['unidade_administrativa_id' => $unidade_administrativa->id]) }}">Editar</a>

                        <a class="btn btn-danger"
                           href="{{ route('unidade_administrativa.delete', ['unidade_administrativa_id' => $unidade_administrativa->id]) }}">Apagar</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
