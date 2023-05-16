@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/list.css">
@endsection

@section('content')
    <div class='container'>
        <div class='row'>
            @if(session('mensagem'))
                <div class='alert alert-success'>
                    <p>{{session('mensagem')}}</p>
                </div>
            @endif
        </div>

        <div class='row'>
            @if(session('error_mensage'))
                <div class='alert alert-danger'>
                    <p>{{session('error_mensage')}}</p>
                </div>
            @endif
        </div>

        <div class='row'>
            @if($errors->any())
                <div class='alert alert-danger'>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
        </div>

        <section class="view-list-acoes">

            <div class="container">

                <div class="row d-flex align-items-center justify-content-end">
                    <a class="criar-acao-button" href={{ route('acao.create') }}>
                        <img src="/images/acoes/listView/criar.svg" alt=""> Criar ação
                    </a>
                </div>

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

            <div class="container">
                <div class="row head-table d-flex align-items-center justify-content-start">
                    <div class="col-4"><span class="spacing-col text-start">Título</span></div>
                    <div class="col-2"><span class="spacing-col">Data</span> <span></span> </div>
                    <div class="col-2"><span>Status</span></div>
                    <div class="col-1 text-center"><span>Natureza</span></div>
                    <div class="col-1 text-center"><span>Anexo</span></div>
                    <div class="col-2 text-center"><span>Atividades</span></div>
                </div>
            </div> 
            
            <div class="list container overflow-scroll">
                @foreach($acaos as $acao)
                <div class="row linha-table d-flex align-items-center justify-content-start">
                    <div class="col-4 titulo-span text-start"><span class="spacing-col titulo-span">{{$acao->titulo}}</span></div>
                    <div class="col-2"><span class="spacing-col">{{date('d-m-Y', strtotime($acao->data_inicio))}}</span></div>
                    <div class="col-2"><span>{{$acao->status}}</span></div>
                    <div class="col-1 text-center"><span>{{$acao->natureza->descricao}}</span></div>
                    <div class="col-1 text-center"><span>
                        @if($acao->anexo != null)
                        <a href="{{ route('anexo.dowload', ['acao_id' => $acao->id])}}"><img src="/images/acoes/listView/anexo.svg" alt="Visualizar" style="opacity: 0.5" ></a>
                        @endif
                    </span></div>
                    <div class="col-2 d-flex align-items-center justify-content-evenly">
                        <span><a href="{{Route('atividade.index', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/ficha.svg" alt="Visualizar"></a></span>
                        <span><a href="{{Route('acao.delete', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir"></a></span>
                        <span><a href="{{Route('acao.edit', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/editar.svg" alt="Editar"></a></span>
                        <span><a href="{{Route('acao.submeter', ['acao_id'=>$acao->id])}}"><img src="/images/acoes/listView/submeter.svg" alt="submeter"></a></span>
                    </div>
                </div>
                @endforeach 
            </div>
        </section>
@endsection
