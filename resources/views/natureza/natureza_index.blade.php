@extends('layouts.app')

@section('title')
    Naturezas
@endsection

@section('content')
    <div class="container">
        <div class="row" >
            @if(session('mensagem'))
            <div class="col-md-12" style="margin-top: 30px;">
                <div class="alert alert-success">
                    <p>{{session('mensagem')}}</p>
                </div>
            </div>
            @endif
        </div>

        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Naturezas</h2>
        </div>
        <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
            <div class='col col-1'>
                <a href="{{route('natureza.create')}}" class="btn btn-success">Cadastrar</a>
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
            @foreach($naturezas as $natureza)
                <tr>
                    <td></td>
                    <td>{{ $natureza->descricao }}</td>
                    <td>
                        <a class="btn btn-secondary" href ="{{ route('natureza.edit', ['natureza_id' => $natureza->id]) }}">Editar</a>

                        <a class="btn btn-danger" href ="{{ route('natureza.delete', ['natureza_id' => $natureza->id]) }}">Apagar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
