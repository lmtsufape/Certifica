@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <div class="container">

                <h1 class="text-center mb-4">Ação Institucional: {{ $acao->titulo }}</h1>

                <div class="text-center mb-3">
                    <h3>Participantes</h3>
                </div>

                <div class="row d-flex align-items-center justify-content-end">
                    @if ($acao->status == null)
                        <button class="btn criar-acao-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Adicionar
                            Participante
                        </button>
                    @endif
                </div>

                <div class="row head-table d-flex align-items-center justify-content-center">
                    <div class="col-4"><span class="spacing-col">Nome</span></div>
                    <div class="col-2"><span>CPF</span></div>
                    <div class="col-2"><span>CH</span></div>
                    <div class="col-2"><span>Atividade/Função</span></div>
                    <div class="col-2"><span></span></div>
                </div>
            </div>

            <div class="list container overflow-scroll">
                @foreach ($participantes as $participante)
                    <div class="row linha-table d-flex align-items-center justify-content-center">
                        <div class="col-4">
                            <span class="spacing-col">
                                {{ $participante->user->name }}
                            </span>
                        </div>

                        <div class="col-2">
                            {{ $participante->user->cpf }}
                        </div>
                        <div class="col-2">
                            {{ $participante->carga_horaria }}
                        </div>

                        <div class="col-2 ">
                            {{ $atividade->descricao }}
                        </div>

                        <div class="col-2 d-flex align-items-center justify-content-evenly">

                            <div class="col-1">

                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-between">
                                <a href="">
                                    <img src="/images/acoes/listView/eye.svg" alt="">
                                </a>

                                @if ($acao->status == 'Aprovada')
                                    <a href="{{ route('participante.ver_certificado', ['participante_id' => $participante->id]) }}"
                                        target="_blank">
                                        <img src="/images/acoes/listView/certificado.svg" alt="">
                                    </a>
                                @endif

                                @if ($acao->status == null)
                                    <a href="{{ route('participante.edit', ['participante_id' => $participante->id]) }}">
                                        <img src="/images/acoes/listView/editar.svg" alt="">
                                    </a>
                                @endif
                                
                                @if (Auth::user()->perfil_id == 2)
                                    <a href="{{ route('participante.delete', ['participante_id' => $participante->id]) }}">
                                        <img src="/images/acoes/listView/lixoIcon.svg" alt="">
                                    </a>
                                @endif

                            </div>
                            <div class="col-5">

                            </div>
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
                        <h5 class="modal-title" id="exampleModalLabel">Informe o seu CPF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="container form"
                        action="{{ Route('participante.create', ['atividade_id' => $atividade->id]) }}" method="GET">
                        <div class="modal-body">
                            <label>CPF:</label>
                            <input class="w-75 form-control" type="text" name="cpf" id="cpf"
                                placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                                title="Digite um CPF válido (000.000.000-00)" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Script do Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
    @endsection
