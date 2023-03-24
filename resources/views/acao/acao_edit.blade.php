@extends('layouts.app')

@section('title')
    Editar Ação
@endsection

@section('content')
    <div class='container'>
        <div class="row">
            @if($errors->any())
                <dic class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </dic>
            @endif
        </div>
    </div>

    <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Ações</h2>
    </div>

    <form action="{{route('acao.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $acao->id }}">

        <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="unidade_administrativa_id" value="{{ Auth::user()->unidade_administrativa_id }}">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="titulo_acaos">Título</label>
                        <input name="titulo" type="text" class="form-control" id="titulo_acaos" placeholder="Título"
                               value="{{ $acao->titulo }}">
                    </div>

                    <div class="form-group">
                        <label for="data_inicio_acaos">Data início</label>
                        <input name="data_inicio" type="date" class="form-control" id="data_inicio_acaos" placeholder="dd/mm/aa"
                               value="{{ $acao->data_inicio }}">
                    </div>

                    <div class="form-group">
                        <label for="data_fim_acaos">Data fim</label>
                        <input name="data_fim" type="date" class="form-control" id="data_fim_acaos" placeholder="dd/mm/aa"
                               value="{{ $acao->data_fim }}">
                    </div>

                    <div class="form-group">
                        <label for="acao_natureza">Natureza</label>

                        <select name="natureza_id" id="natureza" class="form-control">
                            <option value=" {{ $acao->natureza_id }}" selected hidden>{{ $natureza->descricao }}</option>
                            @foreach($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
