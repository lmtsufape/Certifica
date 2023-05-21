@extends('layouts.app')

@section('title')
    Editar Unidade administrativa
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Editar Unidade Administrativa</h2>
        </div>

        <form action="{{Route('unidade_administrativa.update')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{$unidade_administrativa->id}}">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="descricao_unidade_administrativa">Descrição</label>
                            <input name="descricao" type="text" class="form-control"
                                   id="descricao_unidade_administrativa" placeholder="Descrição"
                                   value="{{ $unidade_administrativa->descricao }}">
                        </div>


                        <input type="hidden" name="unidade_administrativa_id" value="1">

                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
@endsection
