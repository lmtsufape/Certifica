@extends('layouts.app')

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


    <form class="container-form-cadastro-usuario form card mx-auto shadow-lg p-3 mb-5 bg-white rounded"
        action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        <h2 class="text-center mb-3">Cadastro de Usuário</h2>

        @csrf

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Nome completo<span class="ast">*</span></span>
                <input class="w-100 input-text h-100 " type="text" name="name" id="nome" required>
            </div>
        </div>

        <!--checkbox para escolher passaporte e cpf -->
        <div class="row d-flex aligm-items-start justify-content-center">
            <div class="col-10 d-flex  align-items-center justify-content-evenly ">
                <div class="col-2 ">
                    <input type="radio" name="cpf_pass" id="cpf_pass" value="cpf" checked> CPF
                </div>
                <div class="col-10">
                    <input type="radio" name="cpf_pass" id="cpf_pass" value="passaporte"> Passaporte
                </div>
            </div>
        </div>
  
        <div id="cpf_dinamico" class="row camporegister_dinamico_show">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">CPF<span class="ast">*</span></span>
                <input class="w-100 h-100 input-text " type="text" name="cpf" id="cpf">
            </div>
        </div>
      

        <div id="passaporte_dinamico" class="row camporegister_dinamico_hide">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Passaporte<span class="ast">*</span></span>
                <input class="w-100 h-100 input-text " type="text" name="passaporte" id="passaporte">
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">E-mail<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="email" name="email" id="email" required>
            </div>
        </div>
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
                    <option value="4"> Estudante </option>
                    <option value="2"> Professor </option>
                    <option value="0"> Técnico </option>
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

        <div class="row d-flex aligm-items-center justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Instituição de vínculo<span class="ast">*</span></span>

                <select class="select-form w-100 " name="instituicao_id" id="select_instituicao" required>
                    <option selected hidden></option>
                    @foreach ($instituicoes as $instituicao)
                        <option value="{{ $instituicao->id }}"
                            @if (old('instituicao_id') == $instituicao->id) selected
                            @elseif(isset($user) && $user->instituicao_id == $instituicao->id) selected @endif>
                            {{ $instituicao->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row camporegister_dinamico_hide" id="outra_instituicao">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Outra Instituição<span class="ast">*</span></span>
                <input class="w-100 h-100 input-text" type="text" name="instituicao" id=""
                    @if (isset($user) && $user->instituicao_id == 2) value="{{ $user->instituicao }}" @endif>
            </div>
        </div>


        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Senha<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="password" name="password" id="senha" required>
            </div>
        </div>
        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Confirmar senha<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="password" name="password_confirmation"
                    id="confirmacao_senha" required>
            </div>
        </div>
        <div class="row d-flex align-items-center justify-content-center">

            <button class="col-3" type="submit">Cadastrar</button>

        </div>
    </form>
@endsection

@push('scripts')
    <script src="/js/email-to-lower.js"></script>
    <script src="/js/auth/register.js"></script>
    <script src="/js/auth/cpf_passaporte.js"></script>
@endpush