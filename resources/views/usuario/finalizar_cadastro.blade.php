@extends('layouts.app')

@section('title')
    Cadastrar Usuário
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastroUsuario.css">
@endsection

@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="col-md-12" style="margin-top: 30px;">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </div>
            </div>
        @endif
    </div>


    <form class="container-form-cadastro-usuario form card mx-auto shadow-lg p-3 mb-5 bg-white rounded" action="{{ route('usuario.finalizar_cadastro') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h2 class="text-center mb-3">Finalizar Cadastro</h2>

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Celular<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="text" name="celular" id="telefone" required>
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Perfil<span class="ast">*</span></span>
                <select class="select-form w-100 h-100" name="perfil_id" id="select_perfil" required>
                    <option selected hidden> -- Perfil --</option>
                    <option value="estudante"> Estudante </option>
                    <option value="professor"> Professor </option>
                    <option value="tecnico"> Técnico </option>
                </select>
            </div>
        </div>

        <div class="row camporegister_dinamico_hide" id="siape">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">SIAPE<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="text" name="siape" id="siape">
            </div>
        </div>

        <div class="row camporegister_dinamico_hide " id="cursos_aluno">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Curso<span class="ast">*</span></span>
                <select class="select-form w-100 h-100" name="cursos_ids[]" id="select_curso" style="text-align: center">
                    <option selected hidden> -- Curso --</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}"> {{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row camporegister_dinamico_hide" id="professor_cursos">

            <div class="col-md-10 border align-center">
                <label style="font-weight: bold" for="cursos">Cursos<span class="ast">*</span></label>

                <br>

                @foreach ($cursos as $curso)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="cursos_ids[]" type="checkbox" id="cursos"
                            value="{{ $curso->id }}">
                        <label class="form-check-label" for="inlineCheckbox1">{{ $curso->nome }}</label>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Nova Senha<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="password" name="password" id="senha" required>
            </div>
        </div>
        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Confirmar Senha<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="password" name="password_confirmation"
                    id="confirmacao_senha" required>
            </div>
        </div>
        <div class="row d-flex align-items-center justify-content-center">

            <button class="col-3" type="submit">Cadastrar</button>

        </div>
    </form>

    <script src="js/auth/completar_cadastro.js"></script>
@endsection
