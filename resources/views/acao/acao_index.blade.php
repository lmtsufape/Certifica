@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <h1 class="text-center mb-4">Listar Ações</h1>

            <div class="container">
                <div class="row d-flex align-items-center justify-content-end">
                    <a class="criar-acao-button" href={{ route('acao.create') }}>
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Criar ação
                    </a>
                </div>
                <div class="row head-table d-flex align-items-center justify-content-start">
                    @if (Auth::user()->perfil_id == 3)
                        <div class="col-5 text-start"><span class="spacing-col">Título</span></div>
                        <div class="col-2 text-center"><span>Tipo natureza</span></div>
                        <div class="col-2 text-center"><span>Status</span></div>
                        <div class="col-2 text-center"><span>Funcionalidades</span></div>
                    @else
                        <div class="col-5 text-start"><span class="spacing-col">Título</span></div>
                        <div class="col-1 text-center"><span>Natureza</span></div>
                        <div class="col-2 text-center"><span>Tipo natureza</span></div>
                        <div class="col-1 text-center"><span>Status</span></div>
                        <div class="col-1 text-center"><span>Anexo</span></div>
                        <div class="col-2 text-center"><span>Funcionalidades</span></div>
                    @endif
                </div>
            </div>

            <div class="list container overflow-scroll">
                @foreach ($acaos as $acao)
                    <div class="row linha-table d-flex align-items-center justify-content-start">
                        @if (Auth::user()->perfil_id == 3)
                            <div class="col-5 titulo-span text-start">
                                <span class="spacing-col">{{ $acao->titulo }}</span>
                            </div>
                            <div class="col-2 text-center titulo-span">
                                <span>{{ $acao->tipo_natureza->descricao }}</span>
                            </div>
                            <div class="col-2 text-center">
                                <span>{{ $acao->status }}</span>
                            </div>

                            <div class="col-2 d-flex align-items-center justify-content-evenly">
                                <span>
                                    <a href="">
                                        <img src="/images/acoes/listView/eye.svg" alt="Visualizar dados">
                                    </a>
                                </span>
                                <span>
                                    <a href="{{ Route('atividade.index', ['acao_id' => $acao->id]) }}">
                                        <img src="/images/acoes/listView/atividade.svg" alt="Atividades">
                                    </a>
                                </span>

                                @if ($acao->status == null)
                                    <span>
                                        <a href="{{ Route('acao.edit', ['acao_id' => $acao->id]) }}">
                                            <img src="/images/acoes/listView/editar.svg" alt="Editar">
                                        </a>
                                    </span>

                                    <span>
                                        <a href="{{ Route('acao.delete', ['acao_id' => $acao->id]) }}">
                                            <img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir">
                                        </a>
                                    </span>

                                    <span>
                                        <a href="{{ Route('gestor.gerar_certificados', ['acao_id' => $acao->id]) }}">
                                            <img src="/images/acoes/listView/submeter.svg" alt="emitir certificados">
                                        </a>
                                    </span>
                                @elseif($acao->status == 'Aprovada')
                                    <a href="{{ route('certificados.download', ['acao_id' => $acao->id]) }}">
                                        <img src="/images/acoes/listView/zipcertificados.svg" alt="">
                                    </a>
                                @endif

                            </div>
                        @else
                            <div class="col-5 titulo-span text-start">
                                <span class="spacing-col">{{ $acao->titulo }}</span>
                            </div>
                            <div class="col-1 text-center">
                                <span>{{ $acao->tipo_natureza->natureza->descricao }}</span>
                            </div>
                            <div class="col-2 text-center titulo-span">
                                <span>{{ $acao->tipo_natureza->descricao }}</span>
                            </div>
                            <div class="col-1 text-center">
                                <span>{{ $acao->status }}</span>
                            </div>
                            <div class="col-1 text-center">
                                <span>
                                    @if ($acao->anexo != null)
                                        <a href="{{ route('anexo.download', ['acao_id' => $acao->id]) }}">
                                            <img style="opacity: 0.5" src="/images/acoes/listView/anexo.svg"
                                                alt="Visualizar">
                                        </a>
                                    @endif
                                </span>
                            </div>

                            <div class="col-2 d-flex align-items-center justify-content-evenly">
                                <span>
                                    <a href="">
                                        <img src="/images/acoes/listView/eye.svg" alt="Visualizar dados">
                                    </a>
                                </span>
                                <span>
                                    <a href="{{ Route('atividade.index', ['acao_id' => $acao->id]) }}">
                                        <img src="/images/acoes/listView/atividade.svg" alt="Atividades">
                                    </a>
                                </span>

                                @if ($acao->status == null)
                                    <span>
                                        <a href="{{ Route('acao.edit', ['acao_id' => $acao->id]) }}">
                                            <img src="/images/acoes/listView/editar.svg" alt="Editar">
                                        </a>
                                    </span>

                                    <span>
                                        <a href="{{ Route('acao.delete', ['acao_id' => $acao->id]) }}">
                                            <img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir">
                                        </a>
                                    </span>


                                    <span>
                                        <a href="{{ Route('acao.submeter', ['acao_id' => $acao->id]) }}">
                                            <img src="/images/acoes/listView/submeter.svg" alt="submeter">
                                        </a>
                                    </span>
                                @elseif($acao->status == 'Aprovada')
                                    <a href="{{ route('certificados.download', ['acao_id' => $acao->id]) }}">
                                        <img src="/images/acoes/listView/zipcertificados.svg" alt="">
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endsection
