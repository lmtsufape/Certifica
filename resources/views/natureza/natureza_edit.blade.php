@extends('layouts.app')

@section('title')
    Editar Natureza
@endsection

@section('content')
    <form action="{{Route('natureza.update')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $natureza->id }}">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="descricao_natureza">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao_natureza" placeholder="Descrição"
                                value="{{ $natureza->descricao }}" >
                    </div>

                    <input type="hidden" name="tipo_natureza_id" value="{{ $natureza->tipo_natureza_id }}">
                    <input type="hidden" name="unidade_administrativa_id" value="{{ $natureza->unidade_administrativa_id }}">

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
