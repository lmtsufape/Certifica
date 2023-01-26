@extends('layouts.app')

@section('title')
    Editar Unidade administrativa
@endsection

@section('content')
    <form action="{{Route('unidade_administrativa.update')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{$unidade_administrativa->id}}">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="descricao_unidade_administrativa">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao_unidade_administrativa" placeholder="Descrição"
                               value="{{ $unidade_administrativa->descricao }}">
                    </div>


                    <input type="hidden" name="unidade_administrativa_id" value="1">

                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
