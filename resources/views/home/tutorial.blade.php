@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home/contato.css">
@endsection

@section('content')
    <div class="container">
        <h4>Clique <a target="_blank" href="{{ Route('home.download') }}">aqui</a> para obter o manual do coordenador</h4>
    </div>
@endsection
