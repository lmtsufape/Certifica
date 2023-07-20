@extends('layouts.app')

@section('title')
    Cadastrar Usuário
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
    <link rel="stylesheet" href="/css/cadastros/cadastrarAcao.css">
@endsection

@section('content')
    <h2 class="text-center mb-4">Cadastrar Usuário </h2>
    <form class="container form form-box" action="{{ Route('usuario.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row d-flex aligm-items-start justify-content-start">
            <div class="col-xl-5 campo spacing-row1 input-create-box align-items-start justify-content-start flex-column">
                <span class="tittle-input">Tipo de usuário</span>

                <select class="w-100 input-text" name="perfil_id" id="select_perfil" required>
                    <option value="" selected hidden>Escolher...</option>
                    @foreach ($perfils as $perfil)
                        <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xl-6 campo spacing-row1 input-create-box" id="unidade_administrativa">
                <span class="tittle-input ">Unidade Administrativa</span>

                <select class="w-100 input-text" name="unidade_administrativa_id" required>
                    <option selected hidden>Escolher...</option>
                    @foreach ($unidade_administrativas as $unidade_administrativa)
                        <option value="{{ $unidade_administrativa->id }}">{{ $unidade_administrativa->descricao }}</option>
                    @endforeach
                </select>
            </div>

        </div>


        <div class="row box">

            <div class="col-xl-5 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Nome completo</span>
                <input class="w-75 input-text " type="text" name="name" id="nome" minlength="10" required>
            </div>

            <div class="col-xl-3 campo-dinamico spacing-row1 input-create-box" id="divCpf">
                <span class="tittle-input">CPF</span>
                <input class="w-75 input-text " type="text" name="cpf" id="cpf" placeholder="000.000.000-00"
                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido (000.000.000-00)" required>
            </div>

            <div class="col-xl-3 campo-dinamico spacing-row1 input-create-box " id="divTelefone">
                <span class="tittle-input">Telefone</span>
                <input class="w-75 input-text " type="text" name="telefone" id="telefone" placeholder="(00)0 0000-0000"
                    pattern="(\d{2})\d{5}\-\d{4}" title="Telefone" required>
            </div>

        </div>

        <div class="row box">

            <div class="col-xl-5 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">E-mail</span>
                <input class="w-75 input-text" type="email" name="email" id="" placeholder="example@gmail.com">
            </div>

            <div class="col-xl-3 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Senha</span>
                <input class="w-75 input-text" type="password" name="password" id="">
            </div>
            
            <div class="col-xl-3 campo spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                <span class="tittle-input ">Confirmar Senha</span>
                <input class="w-75 input-text" type="password" name="password_confirmation" id="">
            </div>

        </div>



        <div class="row d-flex justify-content-start align-items-center">
            <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                <a class="d-flex justify-content-center align-items-center cancel" href="{{route('usuario.index') }}"> Cancelar</a>
                <button class="submit" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>

    <script>
        var select_perfil = document.getElementById("select_perfil");
        const divUnidadeADM = document.getElementById("unidade_administrativa");
        const divTelefone = document.getElementById("divTelefone");
        const divCpf = document.getElementById("divCpf");

        var cpf = document.getElementById("cpf");
        var fone = document.getElementById("telefone");

        divUnidadeADM.style.display = "none"
        divTelefone.style.display = ""
        divCpf.style.display = ""

        select_perfil.addEventListener("change",(e)=>{
            if(e.target.value == 3){
                divUnidadeADM.style.display = ""
                divTelefone.style.display = "none"
                divCpf.style.display = "none"
                cpf.removeAttribute("required")
                fone.removeAttribute("required")
            }else{
                divUnidadeADM.style.display = "none"
                divTelefone.style.display = ""
                divCpf.style.display = ""
                cpf.setAttribute("required")
                fone.setAttribute("required")
            }
        })
    </script>
    
@endsection
