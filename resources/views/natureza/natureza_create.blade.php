@extends('layouts.app')

@section('title')
    Cadastrar Naturezas
@endsection

@section('content')
    <form action="{{Route('natureza.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="descricao_natureza">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao_natureza" placeholder="Descrição">
                    </div>

                    <input type="hidden" name="tipo_natureza_id" value="{{ rand(1, 3) }}">
                    <input type="hidden" name="unidade_administrativa_id" value="{{ 1, 3 }}">

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
