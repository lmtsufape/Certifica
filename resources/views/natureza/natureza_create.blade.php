@extends('layouts.app')

@section('title')
    Cadastrar Naturezas
@endsection

@section('content')
    <div class="container">
        <div class="row" >
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>

        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Cadastrar Unidade Administrativa</h2>
        </div>

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

                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>

@endsection
