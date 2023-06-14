@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class='container'>
        <div class="row">

            @if ($errors->any())
                <div class="col-md-12" style="margin-top: 30px;">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <section class="section-view pb-3 pt-4">
            <h2 class="titulo-view mb-4">Validar Certificado</h2>

            <form action="{{ Route('validar_certificado.checar') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="row d-flex aligm-items-start justify-content-start mb-3">
                    <div class="col-md-10 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                        <span class="tittle-input">Validação<strong style="color: red">*</strong></span>
                        <input class="w-75 input-text " type="text" name="codigo_validacao" id="codigo_validacao"
                            placeholder="Código de Validação..." required>
                    </div>
                </div>
    
                <button type="submit" class="">Validar</button>
            </form>    
        </section>
        
    </div>
@endsection
