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

                    <div class="form-group">
                        <label for="tipo_natureza">Tipo Natureza</label>

                        <select name="tipo_natureza_id" id="tipo_natureza" class="form-control">
                            <option value="" selected hidden>Escolher...</option>
                            @foreach($tipo_naturezas as $tipo_natureza)
                                <option value="{{ $tipo_natureza->id }}">{{ $tipo_natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="unidade_administrativa">Unidade Administrativa</label>

                        <select name="unidade_administrativa_id" id="unidade_administrativa" class="form-control">
                            <option value="" selected hidden>Escolher...</option>
                            @foreach($unidade_administrativas as $unidade_administrativa)
                                <option value="{{ $unidade_administrativa->id }}">{{ $unidade_administrativa->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
