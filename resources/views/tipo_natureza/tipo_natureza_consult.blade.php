@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Tipos de Natureza</h2>
        </div>

        <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
            <div class='col col-1'>
                <a href="{{route('tipo_natureza.create')}}" class="btn btn-success">Cadastrar</a>
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
            @foreach($tipo_naturezas as $natureza)
                <tr>
                    <td></td>
                    <td>{{$natureza->descricao}}</td>
                    <td class="text-center">
                        <a class="btn btn-secondary" href="{{ route('tipo_natureza.edit', ['id' => $natureza->id]) }}">Editar</a>

                        <a class="btn btn-danger" href="{{ route('tipo_natureza.delete', ['id' => $natureza->id]) }}">Apagar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
