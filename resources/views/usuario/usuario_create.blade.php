@extends('layouts.app')

@section('content')
    <form action="{{Route('usuario.store')}}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input name="name" type="text" class="form-control" id="nome_usuario" placeholder="Ex: João Silva">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input name="email" type="text" class="form-control" id= placeholder="email_usuario">
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input name="password" type="password" class="form-control" id="senha_usuario">
                    </div>

                    <div class="form-group">
                        <label for="acao_natureza">Perfil</label>

                        <select name="perfil_id" id="usuario_perfil" class="form-control">
                            <option value="" selected hidden>Escolher...</option>
                            @foreach($perfils as $perfil)
                                <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="acao_natureza">Perfil</label>

                        <select name="unidade_administrativa_id" id="usuario_unidade_administrativa" class="form-control">
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
