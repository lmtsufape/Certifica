@extends('layouts.app')

@section('title')
    Editar Participante
@endsection

@section('content')
    <form action="{{Route('atividade.update')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $atividade->id }}">

        <input type="hidden" name="acao_id" value="{{ $acao->id }}">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="descricao_atividade">Descricao</label>
                        <select name="descricao" id="descricao_atividade" class="form-control">
                            <option value="{{ $atividade->descricao }}" selected hidden>{{ $atividade->descricao }}</option>
                            @foreach($descricoes as $descricao)
                                <option value="{{ $descricao }}">{{ $descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inicio_atividade">Início</label>
                        <input name="data_inicio" type="date" class="form-control" id="inicio_atividade"
                               value="{{ $atividade->data_inicio }}">
                    </div>

                    <div class="form-group">
                        <label for="fim_atividade">Fim</label>
                        <input name="data_fim" type="date" class="form-control" id=fim_atividade"
                               value="{{ $atividade->data_fim }}">
                    </div>

                    <div class="form-group">
                        <label for="atividade_acao">Ação</label>
                        <input name="titulo" type="disabled" class="form-control" id="acao_titulo" value="{{ $acao->titulo }}" disabled>
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
