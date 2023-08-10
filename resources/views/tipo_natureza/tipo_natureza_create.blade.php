@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class='container section-geral'>
        <section class="section-view">
            <h2 class="titulo-view mb-4">Cadastrar tipo de natureza</h2>

            <form action={{ Route('tipo_natureza.store') }} method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row d-flex aligm-items-start justify-content-start mb-3">
                    <div class="col-md-6 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Descrição <span class="ast">*</span> </span>
                        <input class="w-75 input-text" type="text" name="descricao" id="descricao"
                            placeholder="Descrição" required>
                    </div>
                </div>
                <div class="row d-flex aligm-items-start justify-content-start mb-3">
                    <div class="col-md-6 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Natureza <span class="ast">*</span> </span>

                        <select name="natureza_id" id="tipo_natureza" class="select-form w-100 " required>
                            <option value="" selected hidden>-- Natureza --</option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row col-md-6 d-flex align-items-center justify-content-start">
                    <div class="col-3 text-center d-flex align-items-center justify-content-start">
                        <a class="button" href="{{route('tipo_natureza.index')}}">
                            voltar
                        </a>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-start">
                        <button type="submit" class="">Cadastrar</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
