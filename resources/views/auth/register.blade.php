@extends('layouts.app')

@section('css')
    <!-- <link rel="stylesheet" href="/css/acoes/create.css"> -->
@endsection

@section('content')
    <h2 class="text-center">Cadastro de Usuário</h2>

    <div class="row" >
        @if($errors->any())
            <div class="col-md-12" style="margin-top: 30px;">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $erro)
                        <li>{{$erro}}</li>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container">
            <input type="hidden" name="instituicao" value="{{ null }}">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <label for="nome"> Nome Completo </label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                           id="nome" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-3">
                    <label for="cpf"> CPF </label>
                    <input class="form-control @error('cpf') is-invalid @enderror" type="text" name="cpf"
                           id="cpf" required>
                </div>

                <div class="col-md-3">
                    <label for="email"> E-mail </label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                           id="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-3">
                    <label for="telefone">Celular</label>
                    <input class="form-control" type="text" name="celular" id="telefone" required>
                </div>

                <div class="col-md-3">
                    <span class="select_perfil"> Perfil </span>
                    <select class="form-control" name="perfil_id" id="select_perfil" required>
                        <option selected hidden> -- Perfil --</option>
                        <option value="4"> Estudante </option>
                        <option value="2"> Professor </option>
                        <option value="0"> Técnico </option>
                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-3">
                    <label for="select_instituicao"> Instituição de Vínculo </label>
                    <select class="form-control" name="instituicao_id" id="select_instituicao" style="text-align: center" required>
                        <option selected hidden> -- Instituição --</option>
                        @foreach($instituicoes as $instituicao)
                            <option value="{{ $instituicao->id }}"> {{ $instituicao->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3" id="siape" style="display: none">
                    <label for="siape"> Siape </label>
                    <input class="form-control" type="text" name="siape" id="siape">
                </div>

                <div class="col-md-3" id="estudante_curso" style="display: none">
                    <label for="cursos"> Curso </label>

                    <br>

                    <select class="form-control" name="cursos_ids[]" id="select_curso" style="text-align: center">
                        <option selected hidden> -- Curso --</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}"> {{ $curso->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row" id="professor_cursos" style="display: none">
                <div class="col-md-3"></div>

                <div class="col-md-4">
                    <label for="cursos"> Cursos </label>

                    <br>

                    @foreach($cursos as $curso)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="cursos_ids[]" type="checkbox" id="cursos" value="{{ $curso->id }}">
                            <label class="form-check-label" for="inlineCheckbox1">{{ $curso->nome }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-3">
                    <label for="senha"> Senha </label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                           id="senha" required>
                </div>

                <div class="col-md-3">
                    <label for="confirmacao_senha"> Confirmar Senha </label>
                    <input class="form-control" type="password" name="password_confirmation" id="confirmacao_senha" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-2">
                    <label for="voltar"></label>
                    <a class="form-control btn btn-primary" href={{ route('home') }}> Voltar </a>
                </div>

                <div class="col-md-2">
                    <label for="cadastrar"></label>
                    <button class="form-control btn btn-success" type="submit"> Cadastrar-se </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function ()
        {
            $("#select_perfil").change(function () {
                if ($("#select_perfil").val() == 2)
                {
                    $("#professor_cursos").show();
                    $("#siape").show();
                    $("#estudante_curso").hide();
                }
                else if($("#select_perfil").val() == 4)
                {
                    $("#professor_cursos").hide();
                    $("#siape").hide();
                    $("#estudante_curso").show();
                } else if($("#select_perfil").val() == 0)
                {
                    $("#professor_cursos").hide();
                    $("#siape").show();
                    $("#estudante_curso").hide();
                }
            });
        });
    </script>
@endsection


<!--


@error('email')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror

@error('name')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
   </span>
@enderror

@error('name')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror

@error('cpf')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
@enderror

@error('password')
<span class="invalid-feedback" role="alert">
    strong>{{ $message }}</strong
    </span>
@enderror

-->
