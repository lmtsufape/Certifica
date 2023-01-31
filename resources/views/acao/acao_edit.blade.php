@extends('layouts.app')

@section('title')
    Editar Ação
@endsection

@section('content')
    <form action="{{Route('acao.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$acao->id}}">

        <input type="hidden" name="natureza_id" value="1">
        <input type="hidden" name="usuario_id" value="1">

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
                        <label for="ativo">Status</label>
                        <select name="status" class="form-control" id="status_acaos">
                            <option value="0">Sim</option>
                            <option value="1">Não</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
