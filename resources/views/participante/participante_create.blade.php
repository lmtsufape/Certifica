@extends('layouts.app')

@section('title')
    Cadastrar Participantes
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')

    <h1 class="text-center mb-4">Atividade/Função: {{$atividade->descricao}}</h1>
    <h2 class="text-center mb-4">Cadastrar Participante</h2> 
    <form class="container form form-box" action="{{ Route('participante.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">

        <div class="row box ">

            <div class="col-xl-7 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Nome</span>
                <input class="w-100 h-100 input-text " type="text" name="nome" id="nome"
                       @if(isset($user)) value="{{$user->name}}" readonly @endif minlength="10" required>
            </div>

            <div class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input">CPF</span>
                <input class="w-100 h-100 input-text " type="text" name="cpf" id="cpf" placeholder="000.000.000-00"
                       pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido (000.000.000-00)" required
                       @if(isset($user)) value="{{$user->cpf}}" readonly @else value="{{$cpf}}" @endif>
            </div>

        </div>

        <div class="row box">

            <div class="col-xl-7 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">E-mail</span>
                <input class="w-100 h-100 input-text" type="email" name="email" id="" placeholder="example@gmail.com"
                       @if(isset($user)) value="{{$user->email}}" readonly @endif>

            </div>

            <div class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Carga Horária Total</span>
                <input class="w-100 h-100 input-text" type="number" name="carga_horaria" id=""
                       pattern="[0-9]+" title="Digite um número válido" required>

            </div>

        </div>


        <div class="row box">

            <div class="col-xl-7 campo spacing-row1 input-create-box align-items-start justify-content-start flex-column"
                 @if(isset($user)) style="display: none" @endif>
                <span class="tittle-input">Instituição</span>
                <select class="w-100 h-100 input-text" name="instituicao_id" id="select_instituicao" required>
                    <option selected hidden> -- Instituição --</option>
                    @foreach($instituicaos as $instituicao)
                        <option value="{{$instituicao->id}}"
                                @if(old('instituicao_id') == $instituicao->id) selected
                                @elseif(isset($user) && $user->instituicao_id == $instituicao->id) selected @endif>{{$instituicao->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xl-4 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column" id="outra_instituicao">

                <span class="tittle-input">Outra Instituição</span>
                <input class="w-100 h-100 input-text" type="text" name="instituicao" id=""
                       @if(isset($user) && $user->instituicao_id == 2) value="{{$user->instituicao}}" @endif>
            </div>

        </div>

        <div class="row d-flex justify-content-start align-items-center">

            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel"
                   href={{ Route('participante.index',['atividade_id' => $atividade->id]) }}> Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>

    <script>

        var div_Inst = document.getElementById("select_instituicao");
        var div_outrasInst = document.getElementById("outra_instituicao");

        div_outrasInst.style.visibility = "hidden"

        div_Inst.addEventListener("change",(e)=>{
            if(e.target.value == 1){
                div_outrasInst.style.visibility = "hidden"
            }else if(e.target.value == 2){
                div_outrasInst.style.visibility = ""
            }
        })

    </script>

@endsection
