@extends('layouts.app')

@section('title')
    Participantes
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if(session('mensagem'))
                <div class="alert alert-success">
                    {{session('mensagem')}}
                </div>
            @endif
        </div>

        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Participantes: {{ $atividade->descricao }}</h2>
        </div>
        <div class='row justify-content-end' style="padding-bottom: 5px; margin-bottom: 10px">
            @if($acao->status == null)
                <div class='col col-1'>
                    <a href="{{ route('participante.create', ['atividade_id' => $atividade->id]) }}"
                       class="btn btn-success">Cadastrar</a>
                </div>
            @endif
        </div>

        <table class="table table-hover table-responsive-md">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
                <tr>
                    <th scope="col"></th>
                    <th class="text-center" scope="col">Nome</th>
                    <th class="text-center" scope="col">E-mail</th>
                    <th class="text-center" scope="col">CPF</th>
                    <th class="text-center" scope="col">Título</th>
                    <th class="text-center" scope="col">CH</th>
                    <th class="text-center" scope="col"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($participantes as $participante)
                <tr>
                    <td></td>
                    <td class="text-center">{{ $participante->nome }}</td>
                    <td class="text-center">{{ $participante->email }}</td>
                    <td class="text-center">{{ $participante->cpf }}</td>
                    <td class="text-center">{{ $participante->titulo }}</td>
                    <td class="text-center">{{ $participante->carga_horaria }}h</td>

                    <td class="text-center">
                        @if($acao->status == null)
                            <a class="btn btn-secondary"
                               href="{{ route('participante.edit', ['participante_id' => $participante->id]) }}">Editar</a>
                            @if(Auth::user()->perfil_id == 2)
                                <a class="btn btn-danger"
                                   href="{{ route('participante.delete', ['participante_id' => $participante->id]) }}">Apagar</a>
                            @endif
                        @elseif($acao->status == "Aprovada")
                            <a class="btn btn-success" target="_blank"
                               href="{{ route('participante.certificado', ['participante_id' => $participante->id]) }}">Certificado</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
