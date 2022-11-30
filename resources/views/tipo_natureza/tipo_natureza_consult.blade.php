@extends('layouts.app')

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR TIPOS DE NATUREZA</h2>
    </div>

    <table id="tableMateriais" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            
            <th  scope="col" style="padding-left: 10px">ID</th>
            <th  scope="col" style="padding-left: 10px">Descrição</th>
        </tr>
        </thead>
        <tbody>
            @foreach($tipo_naturezas as $tipo_natureza)
            <tr>
                <td>{{$tipo_natureza->id}}</td>
                <td>{{$tipo_natureza->descricao}}</td>

                <td>
                    <div class="dropdown">
                        <div>
                            <a class="dropdown-item" href ="{{ route('tipo_natureza.edit', ['id' => $tipo_natureza->id]) }}">Editar</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href ="{{ route('tipo_natureza.delete', ['id' => $tipo_natureza->id]) }}">Apagar</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection