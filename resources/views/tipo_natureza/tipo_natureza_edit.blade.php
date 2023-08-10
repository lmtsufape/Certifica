@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class='container section-geral'>
        <section class="section-view">
            <h2 class="titulo-view mb-4">Editar tipo de natureza</h2>

            <form action={{Route('tipo_natureza.update', ['id' => $tipo_natureza->id])}} method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <input type="hidden" name="id" value="{{ $tipo_natureza->id }}">

                <div class="row d-flex aligm-items-start justify-content-start mb-3">
                    <div class="col-md-6 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Descrição <span class="ast">*</span> </span>
                        <input class="w-75 input-text" type="text" name="descricao" id="descricao" 
                            placeholder="Descrição" required value="{{$tipo_natureza->descricao}}">
                    </div>
                </div>
                <div class="row d-flex aligm-items-start justify-content-start mb-3">
                    <div class="col-md-6 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Descrição <span class="ast">*</span> </span>

                        <select name="natureza_id" id="tipo_natureza"  class="select-form w-100 " required>
                            <option value="{{ $natureza->id }}" selected hidden>{{ $natureza->descricao }}</option>
                            @foreach ($naturezas as $natureza)
                                <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               
                <div class="row col-md-6 d-flex align-items-center justify-content-evenly">
                    <div class="col-3 text-center d-flex align-items-center justify-content-center">
                        <a class="button" href="{{route('tipo_natureza.index')}}">
                            voltar
                        </a>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <button type="submit" class="">Salvar</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
