@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/home/contato.css">

@endsection

@section('content')
    <div class="container section-view">
        <div class="card">
            <div class="row justify-content-center">        
                <div class="col-3">
                    <h1 class="titulo-card">Tutorial de uso</h1>
                </div>

                <p>
                    Clique <a target="_blank"
                        href="https://drive.google.com/file/d/1fIcEq_dT1trO2Oq-BQB6YB0t2dpuZGDx/view?usp=sharing">aqui</a>
                    para obter o manual em pdf
                </p>
                @include('home.guiaView')
                <p>
                    Clique <a style="color:#B02A3D" target="_blank"
                        href="https://drive.google.com/file/d/1fIcEq_dT1trO2Oq-BQB6YB0t2dpuZGDx/view?usp=sharing">aqui</a>
                    para obter o manual em pdf
                </p>
    
            </div>
        </div>
    </div>
@endsection
