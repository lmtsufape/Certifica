@extends('layouts.app')

@section('title')
    Editar Natureza
@endsection

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class='container section-geral'>
        <section class="section-view pb-3 pt-4">
            <h2 class="titulo-view mb-4">Editar natureza</h2>

            <form action={{ Route('natureza.update') }} method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $natureza->id }}">

                <div class="row d-flex aligm-items-start justify-content-start mb-3">
                    <div class="col-md-6 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Descrição <span class="ast">*</span> </span>
                        <input class="w-75 input-text" type="text" name="descricao" id="descricao"
                            placeholder="Descrição" value="{{ $natureza->descricao }}" required>
                    </div>
                </div>
                <div class="row col-md-6 d-flex align-items-center justify-content-start">
                    <div class="col-3 text-center d-flex align-items-center justify-content-start">
                        <a class="button" href="{{ route('natureza.index') }}">
                            Voltar
                        </a>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-start">
                        <button type="submit" class="">Salvar</button>
                    </div>
                </div>

            </form>
        </section>
    </div>
@endsection
