@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')

<div class="container">        
    <div class="row justify-content-center">
        <div class="col-7">
            <a class="btn btn-primary" href=" {{ route('unidade_administrativa.index') }} " role="button"> Unidades Administrativas </a>           
            <a class="btn btn-primary" href=" {{ route('tipo_natureza.index') }} " role="button"> Tipos de Naturezas </a>
            <a class="btn btn-primary" href=" {{ route('natureza.index') }} " role="button"> Naturezas </a>
            <a class="btn btn-primary" href=" {{ route('usuario.index') }} " role="button"> Usuários </a>
            <a class="btn btn-primary" href="{{ route('certificado_modelo.index') }} "  role="button">Certificados</a>
        </div>
    </div>   
</div>
@endsection
