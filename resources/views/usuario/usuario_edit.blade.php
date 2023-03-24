@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Editar Usuário</h2>
        </div>

        <form action="{{Route('usuario.update')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <input type="hidden" name="id" value="{{ $usuario->id }}">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input name="name" type="text" class="form-control" id="nome_usuario" placeholder="Ex: João Silva"
                                   value="{{ $usuario->name }}">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input name="email" type="text" class="form-control" id= placeholder="email_usuario"
                                   value="{{ $usuario->email }}">
                        </div>

                        <div class="form-group">
                            <label for="acao_natureza">Perfil</label>

                            <select name="perfil_id" id="usuario_perfil" class="form-control">
                                <option value="{{ $perf->id }}" selected hidden>{{ $perf->nome }}</option>
                                @foreach($perfils as $perfil)
                                    <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="acao_natureza">Perfil</label>

                            <select name="unidade_administrativa_id" id="usuario_unidade_administrativa" class="form-control">
                                <option value="{{ $un_administrativa->id }}" selected hidden>{{ $un_administrativa->descricao }}</option>
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
