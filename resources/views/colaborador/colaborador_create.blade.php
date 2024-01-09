@extends('layouts.app')

@section('title')
    Cadastrar Colaborador
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <section class="view-create-acao">
        <h2 class="text-center mb-4">Vincular Colaborador</h2>
        <form class="container form form-box" action="{{ route('colaborador.store', ['acao_id' => $acao->id, 'user_id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row box">
                <div class="col-xl-7 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Nome</span>
                    <input class="w-100 h-100 input-text" type="text" name="nome" id="nome"
                        @if (isset($user)) value="{{ $user->name }}" readonly @endif minlength="5" required>
                </div>

                @if ($option == 'cpf')
                    <div class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">CPF</span>
                        <input class="w-100 h-100 input-text" type="text" name="cpf" id="cpf"
                            placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                            title="Digite um CPF válido (000.000.000-00)" required
                            @if (isset($user)) value="{{ $user->cpf }}" readonly @else value="{{ $cpf }}" @endif>
                    </div>

                    <div style="visibility: hidden" class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Passaporte</span>
                        <input class="w-100 h-100 input-text" type="text" name="passaporte" id="passaporte"
                            placeholder="000.000.000-00" value="">
                    </div>
                @else
                    <div class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">Passaporte</span>
                        <input class="w-100 h-100 input-text" type="text" name="passaporte" id="passaporte"
                            placeholder="000.000.000-00" required
                            @if (isset($user)) value="{{ $user->passaporte }}" readonly @else value="{{ $passaporte }}" @endif>
                    </div>

                    <div style="visibility: hidden" class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                        <span class="tittle-input">CPF</span>
                        <input class="w-100 h-100 input-text" type="text" name="cpf" id="cpf"
                            placeholder="000.000.000-00" title="Digite um CPF válido (000.000.000-00)" value="">
                    </div>
                @endif
        </div>

        <div class="row d-flex justify-content-start align-items-center">
                    <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                        <a class="button d-flex justify-content-center align-items-center cancel" href=""> Voltar</a>
                        <button class="button submit" type="submit">Vincular</button>
                    </div>
                </div>
            </div>
        </form>

        <script src="/js/participante/participante-create.js"></script>
    </section>
@endsection