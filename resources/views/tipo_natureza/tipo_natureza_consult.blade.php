@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row" >
        @if(session('mensagem'))
        <div class="col-md-12" style="margin-top: 30px;">
            <div class="alert alert-success">
                <p>{{session('mensagem')}}</p>
            </div>
        </div>
        @endif
    </div>

    <div class="row" >
        @if(session('error_mensage'))
        <div class="col-md-12" style="margin-top: 30px;">
            <div class="alert alert-danger">
                <p>{{session('error_mensage')}}</p>
            </div>
        </div>
        @endif
    </div>

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR TIPOS DE NATUREZA</h2>
    </div>
    <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
        <div class='col col-1'>
            <a href="{{route('tipo_natureza.create')}}" class="btn btn-success">Cadastrar</a>
        </div>
    </div>
    
    <div >
        <table id="tableMateriais" class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipo_naturezas as $natureza)
                <tr>
                    <td class='col-sm-1'>{{$natureza->id}}</td>
                    <td class='col-sm-9'>{{$natureza->descricao}}</td>
                    <td class='col-sm-2'>
                        <div class="row justify-content-end">
                            <div class='col-4'>
                                <a class="btn btn-success" href ="{{ route('tipo_natureza.edit', ['id' => $natureza->id]) }}">Editar</a>
                            </div>
                            <div class='col-5'>
                                <a class="btn btn-danger" href ="{{ route('tipo_natureza.delete', ['id' => $natureza->id]) }}">Apagar</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection