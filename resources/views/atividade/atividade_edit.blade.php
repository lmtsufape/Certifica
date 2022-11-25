@extends('layouts.app')

@section('title')
    Editar Participante
@endsection

@section('content')
    <form action="{{Route('atividade.update')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $atividade->id }}">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="status_atividade">Status</label>
                        <select name="status" class="form-control" id="status_atividade">
                            <option value="0">Sim</option>
                            <option value="1">Não</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao_atividade">Descricao</label>
                        <input name="descricao" type="text" class="form-control" id="descricao_atividade"
                               placeholder="Monitoria, Extensão, etc" value="{{ $atividade->descricao }}">
                    </div>

                    <div class="form-group">
                        <label for="info_atividade">Informações</label>
                        <input name="info" type="text" class="form-control" id="info_atividade" placeholder="Informações"
                               value="{{ $atividade->info }}">
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
                        <label for="carga_horaria_atividade">Carga Horária</label>
                        <input name="carga_horaria" type="text" class="form-control" id="carga_horaria_atividade" placeholder="Cargas Horário"
                               value="{{ $atividade->carga_horaria }}">
                    </div>

                    <input type="hidden" name="acao_id" value="{{ $atividade->acao_id }}">

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
