@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Cadastrar Usuário</h2>
        </div>

        <form action="{{Route('usuario.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input name="name" type="text" class="form-control" id="usuario_nome" placeholder="Ex: João Silva">
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input name="cpf" type="text" class="form-control" id="usuario_cpf" placeholder="Ex: 11122233344">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input name="email" type="text" class="form-control" id="usuario_email" placeholder="Ex: exemple@gmail.com">
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input name="password" type="password" class="form-control" id="usuario_senha">
                        </div>

                        <div class="form-group">
                            <label for="select_perfil">Perfil</label>

                            <select name="perfil_id" id="select_perfil" class="form-control">
                                <option value="" selected hidden>Escolher...</option>
                                @foreach($perfils as $perfil)
                                    <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="unidade_administrativa">
                            <label for="unidade_administrativa">Unidade Administrativa</label>

                            <select name="unidade_administrativa_id"  class="form-control">
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

    <script>
        $(document).ready(function ()
        {
            $("#select_perfil").change(function ()
            {
                if($("#select_perfil").val() == 4)
                {
                    $("#unidade_administrativa").hide();
                } else
                {
                    $("#unidade_administrativa").show();
                }
            });
        });
    </script>
@endsection
