@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <section class="view-list-acoes">
            <h1 class="text-center mb-4">Listar Ações</h1>
   <!-- 
            <div class="container">
                
                <div class="row head-table search-box d-flex align-items-center justify-content-center">
                    <div class="col-4 d-flex flex-column align-items-start justify-content-center">
                        <span>Buscar ação</span>
                        <input class="input-box w-75" type="text" name="" id="">
                    </div>
                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Status</span>
                        <select class="input-box w-75" name="" id="">
                            <option value="">1</option>
                            <option value="">1</option>
                            <option value="">1</option>
                        </select>
                    </div>
                    <div class="col-3 d-flex flex-column align-items-start justify-content-center">
                        <span>Natureza</span>
                        <select class="input-box w-75" name="" id="">
                            <option value="">1</option>
                            <option value="">1</option>
                            <option value="">1</option>
                        </select>
                    </div>
                    <div class="col-2 d-flex flex-column align-items-start justify-content-center">
                        <span>Data</span>
                        <input class="input-box w-75" type="date" name="" id="">
                    </div>
                </div>
            </div>
            -->

            <div class="container">
                <div class="row d-flex align-items-center justify-content-end">
                    <a class="criar-acao-button" href={{ route('acao.create') }}>
                        <img class="iconAdd" src="/images/acoes/listView/criar.svg" alt=""> Criar ação
                    </a>
                </div>
                <div class="row head-table d-flex align-items-center justify-content-start">
                    <div class="col-5 text-start"><span class="spacing-col">Título</span></div>
                    <div class="col-1 text-center"><span>Natureza</span></div>
                    <div class="col-2 text-center"><span>Tipo natureza</span></div>
                    <div class="col-1 text-center"><span>Status</span></div>
                    <div class="col-1 text-center"><span>Anexo</span></div>
                    <div class="col-2 text-center"><span>Funcionalidades</span></div>
                </div>
            </div>

            <div class="list container overflow-scroll">
                @foreach($acaos as $acao)
                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div class="col-5 titulo-span text-start"><span class="spacing-col">{{$acao->titulo}}</span></div>
                    <div class="col-1 text-center"><span>{{$acao->tipo_natureza->natureza->descricao}}</span></div>
                    <div class="col-2 text-center titulo-span"><span>{{$acao->tipo_natureza->descricao}}</span></div>
                    <div class="col-1 text-center"><span>{{$acao->status}}</span></div>
                    <div class="col-1 text-center"><span>
                        @if($acao->anexo != null)
                        <a href="{{ route('anexo.dowload', ['acao_id' => $acao->id])}}"><img src="/images/acoes/listView/anexo.svg" alt="Visualizar" style="opacity: 0.5" ></a>
                        @endif
                    </span></div>
                    <div class="col-2 d-flex align-items-center justify-content-evenly">
                        <span><a href="{{Route('atividade.index', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/ficha.svg" alt="Visualizar"></a></span>
                        @if($acao->status == null)
                        <span><a href="{{Route('acao.delete', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir"></a></span>
                        <span><a href="{{Route('acao.edit', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/editar.svg" alt="Editar"></a></span>
                        <span><a href="{{Route('acao.submeter', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/submeter.svg" alt="submeter"></a></span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>
@endsection
