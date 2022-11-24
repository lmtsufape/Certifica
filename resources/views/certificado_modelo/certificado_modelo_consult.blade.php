@extends('layouts.app')

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR ASSINATURAS</h2>
    </div>

    <table id="tableMateriais" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            
            <th  scope="col" style="padding-left: 10px">ID</th>
            <th  scope="col" style="padding-left: 10px">unidade_administrativa_id</th>
            <th  scope="col" style="padding-left: 10px">ID unidade_administrativa_id assinatura_equerda assinatura_direita data_posicao texto_posicao</th>
        </tr>
        </thead>
        <tbody>
            @foreach($certificado_modelos as $certificado_modelo)
            <tr>
                <td>{{$certificado_modelo->id}}</td>
                <td>{{$certificado_modelo->unidade_administrativa_id}}</td>
                <td>{{$certificado_modelo->assinatura_esquerda}}</td>
                <td>{{$certificado_modelo->assinatura_direita}}</td>
                <td>{{$certificado_modelo->data_posicao}}</td>
                <td>{{$certificado_modelo->texto_posicao}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection