@extends('layouts.app')

@section('css')
    
@endsection

@section('content')
    <div class="container">
        @include('home.guiaView')
        <h4 class="mt-5" >
            Clique <a target="_blank" href="{{ Route('home.download') }}">aqui</a> 
            para obter o manual do coordenador em pdf
        </h4>
    </div>
@endsection
