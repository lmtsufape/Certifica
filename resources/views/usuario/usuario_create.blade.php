@extends('layouts.app')

@section('title')
    Cadastrar Usuário
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">

    <style>
        .form-card {
            padding: 20px;
            margin-bottom: 20px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <section class="view-create-acao">

        <h2 class="text-center mb-4">Cadastrar usuário</h2>

        <form class="container form form-box" action="{{ route('usuario.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            {{-- Tipo de conta (fixo no topo) --}}
            <div class="container mb-4">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-6 campo spacing-row1 input-create-box">
                        <span class="tittle-input">Tipo de conta</span>
                        <select class="w-100 input-text" name="tipo_conta" id="tipo_conta" required>
                            <option value="normal" selected>Normal</option>
                            <option value="servico">Serviço</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Formulário Normal --}}
            <div id="form-normal" class="form-card">
                <div id="form-normal">
                    <div class="row d-flex aligm-items-start justify-content-start">
                        <div
                            class="col-xl-4 campo spacing-row1 input-create-box align-items-start justify-content-start flex-column">
                            <span class="tittle-input">Tipo de usuário</span>
                            <select class="w-100 input-text" name="perfil_id" id="select_perfil" required>
                                <option value="" selected hidden>Escolher...</option>
                                @foreach ($perfils as $perfil)
                                    <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-4 campo spacing-row1 input-create-box" id="unidade_administrativa">
                            <span class="tittle-input">Unidade Administrativa</span>
                            <select class="w-100 input-text" name="unidade_administrativa_id" required>
                                <option selected hidden>Escolher...</option>
                                @foreach ($unidade_administrativas as $unidade_administrativa)
                                    <option value="{{ $unidade_administrativa->id }}">
                                        {{ $unidade_administrativa->descricao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="select_pass_cpf" class="col-xl-4">
                            <div class="d-flex align-items-center justify-content-around">
                                <div style="margin:0 0 0 5px;" class="col-2">
                                    <input type="radio" name="cpf_pass" value="cpf" checked> CPF
                                </div>
                                <div style="margin:0 0 0 -10px;" class="col-10">
                                    <input type="radio" name="cpf_pass" value="passaporte"> Passaporte
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row box">
                        <div
                            class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                            <span class="tittle-input">Nome completo</span>
                            <input class="w-75 input-text" type="text" name="name" id="nome" minlength="10"
                                required>
                        </div>

                        <div class="col-xl-4 campo-dinamico spacing-row1 input-create-box" id="divCpf">
                            <span class="tittle-input">CPF</span>
                            <input class="w-75 input-text" type="text" name="cpf" id="cpf"
                                placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        </div>

                        <div class="col-xl-4 campo-dinamico spacing-row1 input-create-box" id="passaporte_dinamico">
                            <span class="tittle-input">Passaporte</span>
                            <input class="w-75 input-text" type="text" name="passaporte" id="passaporte">
                        </div>

                        <div class="col-xl-4 campo-dinamico spacing-row1 input-create-box" id="divTelefone">
                            <span class="tittle-input">Telefone</span>
                            <input class="w-75 input-text" type="text" name="telefone" id="telefone"
                                placeholder="(00)0 0000-0000" pattern="(\d{2})\d{5}\-\d{4}" required>
                        </div>
                    </div>

                    <div class="row box">
                        <div
                            class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                            <span class="tittle-input">E-mail</span>
                            <input class="w-75 input-text" type="email" name="email" id="email"
                                placeholder="example@gmail.com" required>
                        </div>

                        <div
                            class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                            <span class="tittle-input">Senha</span>
                            <input class="w-75 input-text" type="password" name="password">
                        </div>

                        <div
                            class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                            <span class="tittle-input">Confirmar Senha</span>
                            <input class="w-75 input-text" type="password" name="password_confirmation">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Formulário Serviço --}}
            <div id="form-servico" class="form-card" style="display:none;">
                <div class="row justify-content-center">
                    <div class="col-xl-6 campo spacing-row1 input-create-box d-flex flex-column">
                        <span class="tittle-input">Nome do sistema</span>
                        <input class="w-100 input-text" type="text" name="name" id="nome_sistema" required>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-6 campo spacing-row1 input-create-box d-flex flex-column">
                        <span class="tittle-input">Tipo de usuário</span>
                        <input class="w-100 input-text" type="text" value="Sistema" disabled>
                        <input type="hidden" name="perfil_id" value="{{ $perfilSistemaId ?? '' }}">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-6 campo spacing-row1 input-create-box d-flex flex-column">
                        <span class="tittle-input">E-mail (gerado automaticamente)</span>
                        <input class="w-100 input-text" type="email" name="email" id="email_sistema" readonly>
                    </div>
                </div>
            </div>

            {{-- Botões --}}
            <div class="row d-flex justify-content-start align-items-center mt-4">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="button d-flex justify-content-center align-items-center cancel"
                        href="{{ route('usuario.index') }}">
                        Voltar
                    </a>
                    <button class="button submit" type="submit">Cadastrar</button>
                </div>
            </div>
        </form>

        <script src="/js/usuario/usuario-create.js"></script>

        <script>
            $(document).ready(function() {
                $('#tipo_conta').on('change', function() {
                    if ($(this).val() === 'servico') {
                        $('#form-normal').hide().find('input, select').prop('disabled', true);
                        $('#form-servico').show().find('input, select').prop('disabled', false);
                    } else {
                        $('#form-servico').hide().find('input, select').prop('disabled', true);
                        $('#form-normal').show().find('input, select').prop('disabled', false);
                    }
                });

                // Inicialmente desabilitar o formulário de serviço
                $('#form-servico').find('input, select').prop('disabled', true);


                $('#nome_sistema').on('input', function() {
                    let nome = $(this).val()
                        .normalize('NFD') // remove acentos
                        .replace(/[\u0300-\u036f]/g, '') // remove marcas de acento
                        .replace(/[^a-zA-Z0-9\s]/g, '') // remove símbolos e pontuação, inclusive @
                        .trim()
                        .toLowerCase()
                        .replace(/\s+/g, '-'); // troca espaços por hífen

                    $('#email_sistema').val(nome ? nome + '@example.com' : '');
                });

            });
        </script>
    </section>
@endsection

@push('scripts')
    <script src="/js/email-to-lower.js"></script>
@endpush
