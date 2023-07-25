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
                        
                        <form action="{{ Route('validar_certificado.checar') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row d-flex aligm-items-start justify-content-start mb-3 div-teste">
                                <div class="col-md-10 d-flex aligm-items-start justify-content-start flex-column">
                                    <span class="span-text">Validação<strong style="color: red">*</strong></span>
                                    <input class="w-75 input-text-align " type="text" name="codigo_validacao" id="codigo_validacao"
                                    placeholder="Código de Validação..." required>
                                </div>
                            </div>
                            
                            <div class="row justify-content-center">
                                <div class='col-3'>
                                    <button type="submit" class="">Validar</button>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>        
    </div>
    @endsection
    