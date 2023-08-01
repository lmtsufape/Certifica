@extends('layouts.app')

@section('title')
    Editar Usuário
@endsection

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <section class="view-create-acao">


        <h2 class="text-center mb-4">Editar Usuário</h2>
        <form class="container form" action="{{ Route('usuario.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row d-flex aligm-items-start justify-content-start ">

                <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input ">Nome completo</span>
                    <input class="w-75 input-text " type="text" name="name" id="nome" minlength="10"
                        value={{ $usuario->name }}>
                </div>

                <div class="col-4 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input">CPF</span>
                    <input class="w-75 input-text " type="text" name="cpf" id="cpf"
                        placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                        title="Digite um CPF válido (000.000.000-00)" value={{ $usuario->cpf }}>
                </div>

            </div>

            <div class="row d-flex aligm-items-start justify-content-start ">
                <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input ">E-mail</span>
                    <input class="w-75 input-text" type="email" name="email" id=""
                        placeholder="example@gmail.com" value={{ $usuario->email }}>
                </div>

                <div class="col-4 spacing-row1 input-create-box align-items-start justify-content-start flex-column">
                    <span class="tittle-input">Tipo de usuário</span>

                    <select class="w-100 input-text" name="perfil_id" id="select_perfil" required>
                        <option id="perfil_selecionado" value={{ $perf->id }} selected hidden>{{ $perf->nome }}
                        </option>
                        @foreach ($perfils as $perfil)
                            <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row d-flex aligm-items-start justify-content-start">

                <div class="col-7 spacing-row1 input-create-box d-flex align-items-start justify-content-start flex-column "
                    id="unidade_administrativa">
                    <span class="tittle-input ">Unidade Administrativa</span>

                    <select class="w-100 input-text" name="unidade_administrativa_id" required>

                        <option value={{ $un_administrativa->id }} selected hidden>{{ $un_administrativa->descricao }}
                        </option>

                        @foreach ($unidade_administrativas as $unidade_administrativa)
                            <option value="{{ $unidade_administrativa->id }}">{{ $unidade_administrativa->descricao }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="d-flex justify-content-center align-items-center cancel" href="{{ route('usuario.index') }}">
                        Cancelar</a>
                    <button class="submit" type="submit">Cadastrar</button>
                </div>
            </div>
        </form>

        <script>
            var select_perfil = document.getElementById("select_perfil");
            var perfil_selecionado = document.getElementById("perfil_selecionado");
            const divUnidadeADM = document.getElementById("unidade_administrativa");

            if (perfil_selecionado.value == 3) {
                divUnidadeADM.style.visibility = ""
            } else {
                divUnidadeADM.style.visibility = "hidden"
            }

            select_perfil.addEventListener("change", (e) => {
                if (e.target.value == 3) {
                    divUnidadeADM.style.visibility = ""
                } else {
                    divUnidadeADM.style.visibility = "hidden"
                }
            })
        </script>
    </section>
@endsection
