@extends('layouts.app')

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR Certificados</h2>
    </div>

    <table id="tableMateriais" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            
            <th  scope="col" style="padding-left: 10px">ID</th>
            <th  scope="col" style="padding-left: 10px">atividade_id</th>
            <th  scope="col" style="padding-left: 10px">certificado_modelo_id</th>
            <th  scope="col" style="padding-left: 10px">assinatura_esquerda</th>
            <th  scope="col" style="padding-left: 10px">img_fundo</th>
            <th  scope="col" style="padding-left: 10px">texto</th>
            <th  scope="col" style="padding-left: 10px">logo</th>
        </tr>
        </thead>
        <tbody>
            @foreach($certificados as $certificado)
            <tr>
                <td>{{$certificado->id}}</td>
                <td>{{$certificado->atividade_id}}</td>
                <td>{{$certificado->certificado_modelo_id}}</td>
                <td>{{$certificado->assinatura_esquerda}}</td>
                <td>{{$certificado->img_fundo}}</td>
                <td>{{$certificado->texto}}</td>
                <td>{{$certificado->logo}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection