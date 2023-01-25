@extends('layouts.app')

@section('title')
    Cadastrar Participantes
@endsection

@section('content')
    <form action="{{Route('participante.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

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
                        <select name="ativo" class="form-control" id="ativo_participante">
                            <option value="0">Sim</option>
                            <option value="1">Não</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="participante_atividade">Atividade</label>

                        <select name="atividade_id" id="participante_atividade" class="form-control">
                            <option value="" selected hidden>Escolher...</option>
                            @foreach($atividades as $atividade)
                                <option value="{{ $atividade->id }}">{{ $atividade->descricao }}</option>
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
