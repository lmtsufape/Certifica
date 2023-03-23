@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <a class="btn btn-primary" href=" {{ route('acao.index') }} " role="button"> Ações </a>
            </div>
        </div>
    </div>
@endsection
