@extends('layouts.app')


@section('content')
<div class="container">
    <div class='row justify-content-center'>
        <div class='col-10' style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>MODELOS DE CERTIFICADOS</h2>
        </div>

        @if(Auth::user()->perfil_id == 1)
            <div class="col-2" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
                <a href="{{route('certificado_modelo.create')}}" class='btn btn-primary' style='margin-bottom: 10px'>Cadastrar</a>
            </div>
        @elseif(Auth::user()->perfil_id == 3)
            <div class="col-2" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
                <a href="{{route('tipo_certificado_modelo.create')}}" class='btn btn-primary' style='margin-bottom: 10px'>Cadastrar</a>
            </div>
        @endif



    <table id="tableMateriais" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th  scope="col" style="padding-left: 10px">Descrição</th>
                <th  scope="col" style="padding-left: 10px">Únidade Administrativa</th>
                <th  scope="col" style="padding-left: 10px">Detalhes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certificado_modelos as $modelo)
            <tr>
                <td>{{$modelo->descricao}}</td>
                <td>@if($modelo->unidadeAdministrativa) {{$modelo->unidadeAdministrativa->descricao}} @endif</td>
                <td>
                    <a href="{{route('certificado_modelo.show', ['id'=>$modelo->id])}}" class="btn btn-sm btn-outline-secondary">Detalhes</a>
                    <a href="{{route('certificado_modelo.delete', ['id' => $modelo->id])}}" class="btn btn-sm btn-outline-danger">Excluir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
