@extends('layouts.app')

@section('title')
    Cadastrar Participantes
@endsection

@section('content')
    <form>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome_participante">Nome</label>
                        <input name="nome" type="text" class="form-control" id="nome_participante" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label for="cpf_participante">CPF</label>
                        <input name="cpf" type="text" class="form-control" id="cpf_participante" placeholder="000.000.000-00">
                    </div>

                    <div class="form-group">
                        <label for="email_participante">Email</label>
                        <input name="email" type="text" class="form-control" id="email_participante" placeholder="example@gmail.com">
                    </div>

                    <div class="form-group">
                        <label for="ativo">Ativo</label>
                        <select name="ativo" class="form-control" id="exampleFormControlSelect1">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="atividade_id_participante">Atividade ID</label>
                        <input name="atividade_id" type="text" class="form-control" id="atividade_id_participante" placeholder="Atividade ID">
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

@endsection
