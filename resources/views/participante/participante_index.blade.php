@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">

    <style>
        .bootstrap-select .dropdown-menu {
            max-height: 400px !important;
            max-width: 300px !important;
        }
    </style>
@endsection

@section('content')
    <section class="view-list-acoes">
        <div class="container">

            <h1 class="text-center mb-4">Ação institucional: {{ $acao->titulo }}</h1>

            <h2 class="text-center mb-4">Atividade: {{ $atividade->descricao }} </h2>

            <div class="text-center mb-3">
                <h3>Integrantes</h3>
            </div>


            <div class="row d-flex align-items-center justify-content-between">

                <div class="col-1">


                    @if ($solicitacao)
                        <a type="button" class="button d-flex align-items-center justify-content-around between"
                            href="{{ route('gestor.analisar_acao', ['acao_id' => $acao->id]) }}">
                            Voltar
                            <img src="/images/acoes/listView/voltar.svg" alt="">
                        </a>
                    @else
                        <a type="button" class="button d-flex align-items-center justify-content-around between"
                            href="{{ route('atividade.index', ['acao_id' => $acao->id]) }}">
                            Voltar
                            <img src="/images/acoes/listView/voltar.svg" alt="">
                        </a>
                    @endif
                </div>

                <div class="col-9 text-end">
                    @if ($acao->status == null || 'Devolvida')
                        <button class="btn criar-acao-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Adicionar
                            Integrante
                        </button>
                    @endif
                </div>
            </div>


            <div class="row head-table d-flex align-items-center justify-content-center">
                <div class="col-1 text-center">N°</div>
                <div class="col-2"><span>Nome</span></div>
                <div class="col-2"><span>E-mail</span></div>
                <div class="col-2"><span>CPF/ Passaporte</span></div>
                <div class="col-1"><span>CH</span></div>
                <div class="col-2"><span>Atividade / Função</span></div>
                <div class="col-2 text-center"><span>Funcionalidades</span></div>
            </div>
        </div>

        <div class="list container">
            @foreach ($participantes as $participante)
                <div class="row linha-table d-flex align-items-center justify-content-center">
                    <div class="col-1 text-center">
                        {{ ++$cont }}
                    </div>
                    <div class="col-2">
                        <span>
                            {{ $participante->user->name }}
                        </span>
                    </div>

                    <div class="col-2">
                        <span>
                            {{ $participante->user->email }}
                        </span>
                    </div>

                    <div class="col-2">
                        @if ($participante->user->cpf != null)
                            {{ $participante->user->cpf }}
                        @else
                            {{ $participante->user->passaporte }}
                        @endif
                    </div>

                    <div class="col-1">
                        {{ $participante->carga_horaria }}
                    </div>

                    <div class="col-2 ">
                        {{ $atividade->descricao }}
                    </div>


                    <div class="col-2 d-flex align-items-center justify-content-center gap-2">
                        @if ($acao->status == 'Aprovada')
                            <a href="{{ route('participante.ver_certificado', ['participante_id' => $participante->id]) }}"
                                target="_blank">
                                <img src="/images/acoes/listView/certificado.svg" alt="" title="Ver Certificado">
                            </a>
                        @endif

                        @if (
                            (Auth::user()->perfil_id == 3 && $acao->status == 'Em análise') ||
                                (Auth::user()->perfil_id == 3 && $acao->status == null))
                            <a href="{{ route('certificado.preview', ['participante_id' => $participante->id]) }}"
                                target="_blank">
                                <img src="/images/acoes/listView/certificado.svg" alt=""
                                    title="Pré-visualizar Certificado">
                            </a>
                        @endif

                        @if ($acao->status == null || $acao->status == 'Devolvida' || Auth::user()->perfil_id == 3)
                            <a href="{{ route('participante.edit', ['participante_id' => $participante->id]) }}">
                                <img src="/images/acoes/listView/editar.svg" alt="" title="Editar">
                            </a>

                            <a onclick="return confirm('Você tem certeza que deseja remover o participante?')"
                                href="{{ route('participante.delete', ['participante_id' => $participante->id]) }}">
                                <img src="/images/acoes/listView/lixoIcon.svg" alt="" title="Excluir">
                            </a>

                            @if (Auth::user()->perfil_id == 3)
                                @if ($participante->invalidar_reemitir_certificado($participante->id))
                                    <a onclick="return confirm('Você tem certeza que deseja emitir/reemitir o certificado deste participante?')"
                                        href="{{ route('participante.reemitir_certificado', ['participante_id' => $participante->id]) }}">
                                        <img src="/images/acoes/listView/reemitir.svg" alt=""
                                            title="Emitir/Reemitir Certificado">
                                    </a>
                                @else
                                    <a onclick="return confirm('Você tem certeza que deseja invalidar o certificado deste participante?')"
                                        href="{{ route('participante.invalidar_certificado', ['participante_id' => $participante->id]) }}">
                                        <img src="/images/acoes/listView/revogar.svg" alt=""
                                            title="Invalidar Certificado">
                                    </a>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informe o seu CPF ou Passaporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="container form"
                    action="{{ Route('participante.create', ['atividade_id' => $atividade->id]) }}" method="GET">
                    <div style="padding:10px 0 20px 90px;" class="modal-body row justify-content-center">

                        <!--checkbox para escolher passaporte e cpf -->
                        <div class="row d-flex aligm-items-start justify-content-center">
                            <div class="col-10 d-flex  align-items-center justify-content-evenly ">
                                <div style="margin:0 5px 0 -3px ;" class="col-2 ">
                                    <input type="radio" name="cpf_pass" id="cpf_pass" value="cpf" checked> CPF
                                </div>

                                <div class="col-10">
                                    <input type="radio" name="cpf_pass" id="cpf_pass" value="passaporte"> Passaporte
                                </div>
                            </div>
                        </div>


                        <div id="cpf_dinamico" class="col-10 camporegister_dinamico_show">
                            <label>CPF:</label>
                            <input class="w-75 form-control" type="text" name="cpf" id="cpf"
                                placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                                title="Digite um CPF válido (000.000.000-00)" required>
                        </div>

                        <div id="passaporte_dinamico" class="col-10 camporegister_dinamico_hide">
                            <label>Passaporte:</label>
                            <input class="w-75 form-control" type="text" name="passaporte" id="passaporte"
                                placeholder=""title="Digite o passaporte">
                        </div>

                        <div class="col-10 mt-3">
                            <label for="user-select">Procurar pelo nome:</label>
                            <select id="user-select" class="selectpicker w-75" data-live-search="true">
                                <option value="" selected>Procurar um usuário</option>
                                @foreach ($dadosUsers as $user)
                                    <option value="{{ $user->cpf }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer row justify-content-center">
                        <div class="col-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn button">Enviar</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script src="/js/auth/cpf_passaporte.js"></script>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#user-select').selectpicker();
        });

        $('#user-select').on('change', function() {
            $('#cpf').val($(this).val());
        });
    </script>
@endpush
