@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastroUsuario.css">
@endsection

@section('title')
    Editar Perfil
@endsection

@section('content')
    <form class="container-form-cadastro-usuario form card mx-auto shadow-lg p-3 mb-5 bg-white rounded"
        action="{{ route('perfil.update') }}" method='POST'>
        <h2 class="text-center mb-3">Editar Perfil</h2>

        @csrf

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Nome completo<span class="ast">*</span></span>
                <input class="w-100 input-text h-100 " type="text" name="name" id="nome" required value="{{ $user->name }}">
            </div>
        </div>

        @if(Auth::user()->perfil_id != 3)
        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">CPF<span class="ast">*</span></span>
                <input class="w-100 h-100 input-text @error('cpf') is-invalid @enderror" type="text" name="cpf" id="cpf" required value="{{ $user->cpf }}">
            </div>
        </div>
        @endif

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">E-mail<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="email" name="email" id="" required value="{{ $user->email }}">
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Celular<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="text" name="celular" id="telefone" required value="{{ $user->celular }}">
            </div>
        </div>
        <div class="row d-flex aligm-items-start justify-content-center">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Perfil<span class="ast">*</span></span>
                        <select class="select-form w-100 h-100" name="perfil_id" id="select_perfil" required>
                            <option selected hidden> -- Perfil --</option>
                            <option value="4" @if($user->perfil->id == 4) selected @endif> Estudante </option>
                            <option value="2" @if($user->perfil->id == 2) selected @endif> Professor </option>
                            <option value="0" @if($user->perfil->id == 0) selected @endif> Técnico </option>
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
                <span class="tittle-input">Instituição de Vínculo<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="text" name="celular" id="telefone" disabled value="{{ $instituicao }}" >
                
            </div>
        </div>
        
        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Senha<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="password" name="password" id="password" required>
            </div>
        </div>

        <div class="row d-flex aligm-items-start justify-content-center ">
            <div class="col-10 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">Confirmar senha<span class="ast">*</span></span>
                <input class="input-text w-100 h-100" type="password" name="password_confirmation" id='password_confirmation' required>
            </div>
        </div>

        <div class="row d-flex align-items-center justify-content-evenly ">
          
            <a class="d-flex justify-content-center align-items-center cancel button mt-4" href="{{route('home')}}">Voltar</a>
            
            <button class="submit button mt-4" type="submit">Salvar</button>

        </div>
        <script src="/js/auth/register.js"></script>
    </form>
@endsection
