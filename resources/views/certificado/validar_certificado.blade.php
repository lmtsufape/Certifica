@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <div class='container'>

        <div class="col-12">
            <div class="row justify-content-center">

                <div class="card">
                    <div class="card-body">

                        <h2 class="titulo-view mb-4">Validar Certificado</h2>

                        <form action="{{ Route('validar_certificado.checar') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row box div-box-input">
                                <div
                                    class="col-xl-12 campo input-create-box d-flex aligm-items-start justify-content-start flex-column">

                                    <span style="background: transparent" class="tittle-input">Validação<span
                                            class="ast">*</span></span>
                                    <input class="w-100 h-100 input-text" type="text" name="codigo_validacao"
                                        id="codigo_validacao" placeholder="Código de Validação..." required>
                                </div>
                            </div>



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
