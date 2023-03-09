@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')

    <a class="btn btn-primary" href=" {{ route('unidade_administrativa.index') }} " role="button"> Unidades Administrativas </a>

    <a class="btn btn-primary" href=" {{ route('tipo_natureza.index') }} " role="button"> Tipos de Naturezas </a>

    <a class="btn btn-primary" href=" {{ route('natureza.index') }} " role="button"> Naturezas </a>

    <a class="btn btn-primary" href="#" role="button"> Usuários </a>
@endsection
