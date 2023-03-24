@extends('layouts.app')

@section('title')
    Editar Natureza
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Editar Natureza</h2>
        </div>
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

                        <div class="form-group">
                            <label for="tipo_natureza">Tipo Natureza</label>

                            <select name="tipo_natureza_id" id="tipo_natureza" class="form-control">
                                <option value="{{ $tipo_natu->id }}" selected hidden>{{ $tipo_natu->descricao }}</option>
                                @foreach($tipo_naturezas as $tipo_natureza)
                                    <option value="{{ $tipo_natureza->id }}">{{ $tipo_natureza->descricao }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="unidade_administrativa">Unidade Administrativa</label>

                            <select name="unidade_administrativa_id" id="unidade_administrativa" class="form-control">
                                <option value="{{ $uni_administrativa->id }}" selected hidden>{{ $uni_administrativa->descricao }}</option>
                                @foreach($unidade_administrativas as $unidade_administrativa)
                                    <option value="{{ $unidade_administrativa->id }}">{{ $unidade_administrativa->descricao }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
@endsection
