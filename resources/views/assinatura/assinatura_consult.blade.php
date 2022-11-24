@extends('layouts.app')

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR ASSINATURAS</h2>
    </div>

    <table id="tableMateriais" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            
            <th  scope="col" style="padding-left: 10px">ID</th>
            <th  scope="col" style="padding-left: 10px">ID DO USUARIO</th>
            <th  scope="col" style="padding-left: 10px">LINK IMG ASSINATURA</th>
        </tr>
        </thead>
        <tbody>
            @foreach($assinaturas as $assinatura)
            <tr>
                <td>{{$assinatura->id}}</td>
                <td>{{$assinatura->usuario_id}}</td>
                <td>{{$assinatura->img_assinatura}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection