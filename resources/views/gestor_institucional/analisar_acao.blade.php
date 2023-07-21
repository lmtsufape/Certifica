@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <h1 class="text-center mb-4">Ação</h1>

            <div class="container">
                <div class="row head-table d-flex align-items-center justify-content-start">
                    <div class="col-4 text-start"><span class="spacing-col">Título</span></div>
                    <div class="col-3 text-start"><span>Início</span></div>
                    <div class="col-3 text-start"><span>Fim</span></div>
                    <div class="col-2 text-start"><span>Funcionalidades</span></div>
                </div>
            </div>

            <div class="list container overflow-scroll">
                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div class="col-4 titulo-span text-start"><span class="spacing-col">{{ $acao->titulo }}</span></div>
                    <div class="col-3 text-start">
                        <span>
                            {{ collect(explode('-', $acao->data_inicio))->reverse()->join('/') }}
                        </span>
                    </div>
                    <div class="col-3 text-start">
                        <span>
                            {{ collect(explode('-', $acao->data_fim))->reverse()->join('/') }}
                        </span>
                    </div>
                    <div class="col-2">
                        <div class="col-6 d-flex align-items-start justify-content-start">
                            <span class="col spacing-col">
                                @if ($acao->anexo != null)
                                    <a href="{{ route('anexo.download', ['acao_id' => $acao->id]) }}">
                                        <img src="/images/acoes/listView/anexo.svg" alt="Visualizar" title="Baixar Anexo">
                                    </a>
                                @endif
                            </span>

                            <span class="col-6 text-center">
                                <a href="{{ Route('acao.edit', ['acao_id' => $acao->id]) }}">
                                    <img src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar">
                                </a>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container">

                <div class="text-center mb-3">
                    <h3>Atividades - {{ $acao->titulo }}</h3>
                </div>

                <div class="row head-table d-flex align-items-center justify-content-center">
                    <div class="col-4"><span class="spacing-col">Descrição</span></div>
                    <div class="col-3"><span>Início</span></div>
                    <div class="col-3"><span>Fim</span></div>
                    <div class="col-2"><span>Funcionalidades</span></div>
                </div>
            </div>

            <div class="list container overflow-scroll">
                @foreach ($atividades as $atividade)
                    <div class="row linha-table d-flex align-items-center justify-content-start">
                        <div class="col-4"><span class="spacing-col">{{ $atividade->descricao }}</span></div>
                        <div class="col-3"><span>
                                {{ collect(explode('-', $atividade->data_inicio))->reverse()->join('/') }}</span></div>
                        <div class="col-3">
                            <span>
                                {{ collect(explode('-', $atividade->data_fim))->reverse()->join('/') }}
                            </span>
                        </div>
                        <div class="col-2">
                            <div class="col-6 d-flex align-items-start justify-content-start">
                                <span class="col-6 text-center">
                                    <a href="{{ route('participante.index', ['atividade_id' => $atividade->id]) }}">
                                        <img src="/images/atividades/participantes.svg" alt="" title="Integrantes">
                                    </a>
                                </span>
                            
                                <span class="col spacing-col">
                                    <a href="{{ route('atividade.edit', ['atividade_id' => $atividade->id]) }}">
                                        <img src="/images/acoes/listView/editar.svg" alt="" title="Editar">
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <form method="POST" id="formAnaliseAcao" name="formAnaliseAcao" action="{{ route('gestor.acao_update') }}">
                @csrf

                <input type="hidden" name="id" value="{{ $acao->id }}">

                <div class="container">
                    <div class="row">
                        @if($acao->status == "Em análise")
                            <div class="form-group">
                                <label for="observacoes">Observações:</label>
                                <textarea class="form-control" id="observacao_gestor" name="observacao_gestor" rows="3"></textarea>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="observacoes">Observações:</label>
                                <textarea class="form-control" id="observacao_gestor" name="observacao_gestor" rows="3" disabled>{{ $acao->observacao_gestor }}</textarea>
                            </div>
                        @endif
                        
                        @if ($acao->status == "Em análise")
                            <div class="col d-flex align-items-center justify-content-evenly mt-4">
                                <button name="action" type="submit" class="buttonAnalisar btn-danger" value="reprovar">Reprovar</button>

                                <button name="action" type="submit" class="buttonAnalisar btn-secondary" value="devolver">Devolver</button>

                                <button name="action" type="submit" class="buttonAnalisar btn-success" value="aprovar">Aprovar</button>
                            </div>
                        @endif
                    </div>

                </div>
            </form>

        </section>
    </div>
@endsection
