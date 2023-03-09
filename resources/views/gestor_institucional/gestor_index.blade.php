@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')

    <a class="btn btn-primary" href=" {{ route('acao.index') }} " role="button"> Ações </a>

    <a class="btn btn-primary" href=" {{ route('gestor.acoes_submetidas') }} " role="button"> Submissões </a>
@endsection
