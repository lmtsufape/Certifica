@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastroUsuario.css">
@endsection

@section('content')
    <div class='container section-geral'>

        <div class="col-12">
            <div class="row justify-content-center">

                <div class="card">
                    <div class="card-body">

                        <h2 class="titulo-view mb-4">Validar Certificado</h2>

                        <form class="d-flex flex-column align-items-center justify-content-center"
                            action="{{ Route('validar_certificado.checar') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input class="w-100 input-text" type="text" name="codigo_validacao"
                                    id="codigo_validacao" placeholder="Código de Validação..." required>

                            <div class="row justify-content-center">
                                <button class="col-4" type="submit" class="">Validar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
